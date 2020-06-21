<?php

namespace App\Http\Controllers\Api;

use App\Categorie;
use App\Endroits;
use App\Events;
use App\Http\Controllers\Controller;
use App\Http\Requests\EndroitRequest;
use App\Http\Resources\EventResource;
use App\Http\Traits\EndroitTrait;
use App\Media;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class EventController extends Controller
{
    use EndroitTrait;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Categorie::where('name','Events')->first()!= null ? Categorie::where('name','Events')->first()->id : 0;
        $events = Endroits::where('categorie_id',$category)->with('events')->get();

        // return response
        $response = [
            'success' => true,
            'message' => 'events retrieved successfully.',
            'data' => EventResource::collection($events),
        ];
        return response()->json($response, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EndroitRequest $request)
    {
        $input = $request->all();
        $endroit = $this->saveEndroit($input);

        events::create(
            [
                'endroits_reference'=>$input["reference"],
                'type'=>$input["type"],
                'startDate'=>$input["startDate"],
                'endDate'=>$input["endDate"]
            ]
        );

        // return response
        $response = [
            'success' => true,
            'message' => 'event created successfully.',
        ];

        return response()->json($response, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $endroit = $this->showEndroit($id,'Events');

        if($endroit){
            $event = $endroit->with('events')->get();

            // return response
            $response = [
                'success' => true,
                'data'    => new EventResource($event),
                'message' => 'event retrieved successfully.',
            ];
            return response()->json($response, 200);
        }
        $response = [
            'success' => false,
            'message' => 'event not found.',
        ];
        return response()->json($response, 404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $input = $request->all();
        $this->updateEndroit($input,$input['reference']);
        Events::where('endroits_reference',$input['reference'])->update([
            'type'=>$input["type"],
            'startDate'=>$input["startDate"],
            'endDate'=>$input["endDate"]
        ]);

        // return response
        $response = [
            'success' => true,
            'message' => 'event updated successfully.',
        ];
        return response()->json($response, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->deleteEndroit($id,'Events');
    }
}
