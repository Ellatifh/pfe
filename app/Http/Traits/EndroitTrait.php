<?php
namespace App\Http\Traits;

use App\Categorie;
use App\Endroits;
use App\Media;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

trait EndroitTrait {

    public function saveEndroit($input)
    {
        $this->authorize('isAdmin');
        $endroit = Endroits::create(
            [
            'reference' => $input["reference"],
            'name'=> $input["name"],
            'description'=> $input["description"],
            'adresse1'=> $input["adresse1"],
            'adresse2'=> $input["adresse2"],
            'email'=> $input["email"],
            'telephone'=> $input["telephone"],
            'website'=> $input["website"],
            'startTime'=> $input["startTime"],
            'endTime'=> $input["endTime"],
            'zipcode'=> $input["zipcode"],
            'longitude'=> $input["longitude"],
            'latitude'=> $input["latitude"],
            'categorie_id'=> $input["categorie"],
            'city_id'=> $input["city"],
            'user_id'=> Auth::user()->id
            ]
        );
        if(isset($input["pictures"])){
            $this->savePictures($input["pictures"],$input["reference"]);
        }
        return $endroit;
    }

    public function updateEndroit($input,$id)
    {
        $endroit = Endroits::where('reference',$id);
        $this->authorize('isOwner',$endroit);
        if($endroit){
            $endroit->update(
                [
                    'name'=> $input["name"],
                    'description'=> $input["description"],
                    'adresse1'=> $input["adresse1"],
                    'adresse2'=> $input["adresse2"],
                    'email'=> $input["email"],
                    'telephone'=> $input["telephone"],
                    'website'=> $input["website"],
                    'startTime'=> $input["startTime"],
                    'endTime'=> $input["endTime"],
                    'zipcode'=> $input["zipcode"],
                    'longitude'=> $input["longitude"],
                    'latitude'=> $input["latitude"],
                    'categorie_id'=> $input["categorie"],
                    'city_id'=> $input["city"]
                ]
            );
            if(isset($input["pictures"])){
                $this->savePictures($input["pictures"],$input["reference"]);
            }
        }

        return null;
    }

    public function showEndroit($id,$category_name)
    {
        $selectedCategory = Categorie::where('name',$category_name)->first();
        $category = $selectedCategory!= null ? $selectedCategory->id : 0;
        $endroit = Endroits::where('reference',$category)->where('reference',$id);
        $this->authorize('isOwner',$endroit);
        if($endroit){
            return $endroit;
        }

        return null;
    }

    public function deleteEndroit($id,$category_name)
    {
        $selectedCategory = Categorie::where('name',$category_name)->first();
        $category = $selectedCategory!= null ? $selectedCategory->id : 0;
        $endroit = Endroits::where(['categorie_id'=>$category,'reference'=>$id]);

        if (!$endroit) {
            $response = [
                'success' => false,
                'message' => 'Endroit not found',
            ];
            return response()->json($response, 404);
        }
        $endroit->delete();

        // return response
        $response = [
            'success' => true,
            'message' => 'Endroit deleted successfully.',
        ];
        return response()->json($response, 200);
    }

    public function savePictures($picutres,$reference){
        if(is_array($picutres) && count($picutres)>0){
            Media::where('endroits_reference',$reference)->delete();
            foreach ($picutres as $value) {
                Media::create([
                    'endroits_reference'=>$reference,
                    'path' => $value['path'],
                    'type' => $value['type']
                ]);
            }
        }
    }

}
