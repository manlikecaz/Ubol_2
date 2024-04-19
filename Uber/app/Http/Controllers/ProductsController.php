<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function createProduct(Request $request){
        $request->validate([
            "product_name"=>"required",
            "image_path"=>"image|mimes:jpeg,png,jpg|max:2048"
        ]);

        $filename = null;

        if($request->has("image_path")){
            $filename = $request->file("image_path")->store("products", "public");
        }

        $product= Products::create([
            'product_name'=>$request->product_name,
            'description'=>$request->description,
            'image_path'=>$filename,
        ]);

        return response()->json($product);
    }

    public function readAllProducts(){
        $products = Products::all();
        if(!$products ->isempty()){
            return response()->json("No product was found",404);
        }
        else {
            return response ()->json($products);
        }
    }

    public function readProduct($id){
        try{
            $product = Products::findOrFail($id);



            if($product){
                return response()->json($product);
            }
            else{
                return response()->json("No product Was Found With The ID: ",$id);
            }   
        }
        catch(\Exception $e){
            return response()->json([
                'error'=>'Unable to update record'
            ],400);
        }
    }

    public function updateProduct($id, Request $request){
        try{
            $request ->validate([
                "product_name"=>"required"
            ]);
            $products=Products::findorFail($id);

            
                $products->area_name = $request ->area_name;
                $products->description = $request ->description;
                $products->save();

                return response()->json($products);
            
        }
        catch(\Exception $e){
            return response()->json([
                'error'=>'Unable to update record'
            ],400);
        }
    }
    

    public function deleteArea($id){
        try{
            $product =Products::findorFail($id);
            if ($product){
               Products::destroy($id);
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
