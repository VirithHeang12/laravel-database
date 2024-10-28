<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SupplierController;

Route::get('/', function () {
    return view('welcome');
})->name('home');


Route::resource('users', UserController::class);

Route::resource('categories', CategoryController::class);
Route::resource('products', ProductController::class);

Route::resource('suppliers', SupplierController::class);

Route::resource('customers', CustomerController::class);
Route::resource('doctors', DoctorController::class);






















