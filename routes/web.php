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
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Index', [
        'title' => 'Dashboard'
    ]);
})->name('home');


Route::resource('users', UserController::class);

Route::resource('categories', CategoryController::class);

Route::get('products/import', [ProductController::class, 'createImport'])->name('products.createImport');
Route::post('products/import', [ProductController::class, 'saveImport'])->name('products.saveImport');
Route::get('products/export', [ProductController::class, 'export'])->name('products.export');
Route::get('products/export-view', [ProductController::class, 'exportView'])->name('products.exportView');
Route::get('products/logs', [ProductController::class, 'logs'])->name('products.logs');
Route::resource('products', ProductController::class);

Route::get('suppliers/import', [SupplierController::class, 'createImport'])->name('suppliers.createImport');
Route::post('suppliers/import', [SupplierController::class, 'saveImport'])->name('suppliers.saveImport');
Route::get('suppliers/export', [SupplierController::class, 'export'])->name('suppliers.export');
Route::get('suppliers/export-view', [SupplierController::class, 'exportView'])->name('suppliers.exportView');
Route::put('suppliers/{supplier}/restore', [SupplierController::class, 'restoreSupplier'])->name('suppliers.restore');
Route::put('/suppliers/restore-all', [SupplierController::class, 'restoreAllSupplier'])->name('suppliers.restoreAll');
Route::get('suppliers/deleted', [SupplierController::class, 'deletedSuppliers'])->name('suppliers.deleted');
Route::resource('suppliers', SupplierController::class);

Route::get('customers/import', [CustomerController::class, 'createImport'])->name('customers.createImport');
Route::post('customers/import', [CustomerController::class, 'saveImport'])->name('customers.saveImport');
Route::get('customers/export', [CustomerController::class, 'export'])->name('customers.export');
Route::get('customers/export-view', [CustomerController::class, 'exportView'])->name('customers.exportView');
Route::put('customers/{customer}/restore', [CustomerController::class, 'restoreCustomer'])->name('customers.restore');
Route::put('/customers/restore-all', [CustomerController::class, 'restoreAllCustomer'])->name('customers.restoreAll');
Route::get('customers/deleted', [CustomerController::class, 'deletedCustomers'])->name('customers.deleted');
Route::resource('customers', CustomerController::class);

Route::get('doctors/import', [DoctorController::class, 'createImport'])->name('doctors.createImport');
Route::post('doctors/import', [DoctorController::class, 'saveImport'])->name('doctors.saveImport');
Route::get('doctors/export', [DoctorController::class, 'export'])->name('doctors.export');

Route::get('doctors/export-view', [DoctorController::class, 'exportView'])->name('doctors.exportView');
Route::put('doctors/{doctor}/restore', [DoctorController::class, 'restoreDoctor'])->name('doctors.restore');
Route::post('doctors/restore-all', [DoctorController::class, 'restoreAllDoctors'])->name('doctors.restoreAll');
Route::get('doctors/deleted', [DoctorController::class, 'deletedDoctors'])->name('doctors.deleted');
Route::resource('doctors', DoctorController::class);

Route::get('books/import', [BookController::class, 'createImport'])->name('books.createImport');
Route::post('books/import', [BookController::class, 'saveImport'])->name('books.saveImport');
Route::get('books/export', [BookController::class, 'export'])->name('books.export');
Route::get('books/export-view', [BookController::class, 'exportView'])->name('books.exportView');
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

