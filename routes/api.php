<?php

use App\Http\Controllers\Api\V1\CarController;
use App\Http\Controllers\Api\v1\ProductController;
use App\Http\Controllers\Api\V1\SupplierController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/products', [ProductController::class, 'index']);
Route::get('/cars', [CarController::class, 'index']);
Route::post('/cars', [CarController::class, 'store']);


Route::get('/suppliers', [SupplierController::class, 'index']);
Route::post('/suppliers', [SupplierController::class,'store']);

