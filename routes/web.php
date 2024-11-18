<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CarController;

Route::get('/', function () {
    return view('welcome');
})->name('home');


Route::resource('users', UserController::class);

Route::resource('categories', CategoryController::class);
Route::resource('products', ProductController::class);

Route::put('suppliers/{supplier}/restore', [SupplierController::class, 'restoreSupplier'])->name('suppliers.restore');
Route::put('/suppliers/restore-all', [SupplierController::class, 'restoreAllSupplier'])->name('suppliers.restoreAll');
Route::get('suppliers/deleted', [SupplierController::class, 'deletedSuppliers'])->name('suppliers.deleted');
Route::resource('suppliers', SupplierController::class);

Route::put('customers/{customer}/restore', [CustomerController::class, 'restoreCustomer'])->name('customers.restore');
Route::put('/customers/restore-all', [CustomerController::class, 'restoreAllCustomer'])->name('customers.restoreAll');
Route::get('customers/deleted', [CustomerController::class, 'deletedCustomers'])->name('customers.deleted');
Route::resource('customers', CustomerController::class);

Route::put('doctors/{doctor}/restore', [DoctorController::class, 'restoreDoctor'])->name('doctors.restore');
Route::get('doctors/deleted', [DoctorController::class, 'deletedDoctors'])->name('doctors.deleted');
Route::resource('doctors', DoctorController::class);


Route::put('books/{book}/restore', [BookController::class, 'restoreBook'])->name('books.restore');
Route::put('/books/restore-all', [BookController::class, 'restoreAllBook'])->name('books.restoreAll');
Route::get('books/deleted', [BookController::class, 'deletedBooks'])->name('books.deleted');
Route::resource('books', BookController::class);

Route::get('cars/import', [CarController::class, 'createImport'])->name('cars.createImport');
Route::post('cars/import', [CarController::class, 'saveImport'])->name('cars.saveImport');

Route::put('cars/{car}/restore', [CarController::class, 'restoreCar'])->name('cars.restore');
Route::get('cars/deleted', [CarController::class, 'deletedCars'])->name('cars.deleted');
Route::resource('cars', CarController::class);
Route::get('popular-cars', [CarController::class, 'popularCars'])->name('cars.popular');

