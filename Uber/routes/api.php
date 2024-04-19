<?php

use App\Http\Controllers\AreasController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ResturantController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//login
Route::post("/login", [AuthController::class, 'login']);
//Auth
Route::post("/register", [AuthController::class, 'register']);

//area
Route::post("/area", [AreasController::class, 'createArea']);
Route::get("/area", [AreasController::class, 'readAllAreas']);
Route::get("/area/{Id}", [AreasController::class, 'readArea']);
Route::get("/area", [AreasController::class, 'UpdateArea']);
Route::delete("/area", [AreasController::class, 'deleteArea']);

//resturant
Route::post("/resturant", [ResturantController::class, 'createResturant']);
Route::get("/resturant", [ResturantController::class, 'readAllResturants']);
Route::get("/resturant/{Id}", [ResturantController::class, 'readResturant']);
Route::get("/resturant", [ResturantController::class, 'UpdateResturant']);
Route::delete("/resturant", [ResturantController::class, 'deleteResturant']);

//products
Route::post("/product", [ProductsController::class, 'createProduct']);
Route::get("/product", [ProductsController::class, 'readAllProducts']);
Route::get("/product/{Id}", [ProductsController::class, 'readProduct']);
Route::get("/product", [ProductsController::class, 'UpdateProduct']);
Route::delete("/product", [ProductsController::class, 'deleteProduct']);
