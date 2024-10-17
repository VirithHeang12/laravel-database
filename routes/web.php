<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
})->name('home');


// About route
Route::get('/about', function () {
    return view('about'); // Return the about view
})->name('about');

Route::resource('users', UserController::class);
Route::resource('products', ProductController::class);




















