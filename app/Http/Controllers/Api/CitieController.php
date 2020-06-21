<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Citie;
use App\Http\Resources\CitieResource;

class CitieController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cities = Citie::all();

        // return response
        $response = [
            'success' => true,
            'message' => 'cities retrieved successfully.',
            'data' => CitieResource::collection($cities),
        ];
        return response()->json($response, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('isAdmin');

        $input = $request->all();

        $this->validate($request, [
            'name' => 'required|unique:cities'
        ]);


        $citie = Citie::create($input);

        // return response
        $response = [
            'success' => true,
            'message' => 'citie created successfully.',
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
        $citie = Citie::find($id);

        if (is_null($citie)) {
            // return response
            $response = [
                'success' => false,
                'message' => 'citie not found.',
            ];
            return response()->json($response, 404);
        }

        // return response
        $response = [
            'success' => true,
            'data'    => new CitieResource($citie),
            'message' => 'citie retrieved successfully.',
        ];
        return response()->json($response, 200);
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
        $this->authorize('isAdmin');

        $input = $request->all();
        $citie = Citie::find($id);

        $this->validate($request, [
            'name' => 'required'
        ]);


        if (!$citie) {
            $response = [
                'success' => false,
                'message' => 'Citie not found',
            ];
            return response()->json($response, 404);
        }

        $citie->name = $input['name'];
        $citie->save();

        // return response
        $response = [
            'success' => true,
            'message' => 'citie updated successfully.',
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
        $this->authorize('isAdmin');
        $citie = Citie::find($id);

        if (!$citie) {
            $response = [
                'success' => false,
                'message' => 'Citie not found',
            ];
            return response()->json($response, 404);
        }
        $citie->delete();

        // return response
        $response = [
            'success' => true,
            'message' => 'citie deleted successfully.',
        ];
        return response()->json($response, 200);
    }
}
