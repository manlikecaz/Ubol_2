<?php

namespace App\Http\Controllers;

use App\Models\Areas;
use Illuminate\Http\Request;

class AreasController extends Controller
{
    public function createArea(Request $request){
        $request->validate([
            "area_name"=>"required"
        ]);

        $area = Areas::create([
            'area_name'=>$request->area_name,
            'description'=>$request->description,
        ]);

        return response()->json($area);
    }

    public function readAllAreas(){
        $areas = Areas::all();
        if(!$areas ->isempty()){
            return response()->json("No area was found",404);
        }
        else {
            return response ()->json($areas);
        }
    }

    public function readArea($id){
        try{
            $area = Areas::findOrFail($id);



            if($area){
                return response()->json($area);
            }
            else{
                return response()->json("No Area Was Found With The ID: ",$id);
            }   
        }
        catch(\Exception $e){
            return response()->json([
                'error'=>'Unable to update record'
            ],400);
        }
    }

    public function updateArea($id, Request $request){
        try{
            $request ->validate([
                "area_name"=>"required"
            ]);
            $areas= Areas::findorFail($id);

            
                $areas->area_name = $request ->area_name;
                $areas->description = $request ->description;
                $areas->save();

                return response()->json($areas);
            
        }
        catch(\Exception $e){
            return response()->json([
                'error'=>'Unable to update record'
            ],400);
        }
    }
    

    public function deleteArea($id){
        try{
            $area = Areas::findorFail($id);
            if ($area){
                Areas::destroy($id);
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
