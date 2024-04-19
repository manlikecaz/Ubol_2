<?php

namespace App\Http\Controllers;
use App\Models\Resturant;
use Illuminate\Http\Request;

class ResturantController extends Controller
{
    public function createresturant(Request $request){
        $request->validate([
            "resturant_name"=>"required",
            "location"=>"required",
            "image_path"=>"image|mimes:jpeg,png,jpg|max:2048"
        ]);
        $filename = null;

        if($request->has("image_path")){
            $filename = $request->file("image_path")->store("resturants", "public");
        }

        $resturant = Resturant::create([
            'resturant_name'=>$request->resturant_name,
            'location'=>$request->location,
            'description'=>$request->description,
            'image_path'=>$filename,
        ]);

        return response()->json($resturant);
    }

    public function readAllResturants(){
        $resturants = Resturant::all();
        if(!$resturants ->isempty()){
            return response()->json("No resturant was found",404);
        }
        else {
            return response ()->json($resturants);
        }
    }

    public function readresturant($id){
        try{
            $resturant = Resturant::findOrFail($id);



            if($resturant){
                return response()->json($resturant);
            }
            else{
                return response()->json("No resturant Was Found With The ID: ",$id);
            }   
        }
        catch(\Exception $e){
            return response()->json([
                'error'=>'Unable to update record'
            ],400);
        }
    }

    public function updateresturant($id, Request $request){
        try{
            $request ->validate([
                "resturant_name"=>"required"
            ]);
            $resturants= Resturant::findorFail($id);

            
                $resturants->resturant_name = $request ->resturant_name;
                $resturants->description = $request ->description;
                $resturants->save();

                return response()->json($resturants);
            
        }
        catch(\Exception $e){
            return response()->json([
                'error'=>'Unable to update record'
            ],400);
        }
    }
    

    public function deleteresturant($id){
        try{
            $resturant = Resturant::findorFail($id);
            if ($resturant){
                Resturant::destroy($id);
                return response()->json("Record has been successfuly deleted ");
            }
            else{
                return response()->json("Record does not exist");
            }
        }
        catch(\Exception $e){
            return response()->json([
                'error'=>'Unable to update record'
            ],400);
        }
    }
}
