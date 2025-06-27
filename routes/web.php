<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [HomeController::class, 'index']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/redirect', [HomeController::class, 'redirect']);

Route::get('/view_category', [AdminController::class, 'view_category']);

Route::post('/add_category', [AdminController::class, 'add_category']);

Route::get('/delete_category/{id}', [AdminController::class, 'delete_category']);

Route::get('/view_product', [AdminController::class, 'view_product']);

Route::post('/add_product', [AdminController::class, 'add_product']);

Route::get('/test_add_product', [AdminController::class, 'test_add_product']);

Route::get('/show_product', [AdminController::class, 'show_product']);

Route::get('/update_product/{id}', [AdminController::class, 'update_product']);

Route::put('/edit_product/{id}', [AdminController::class, 'edit_product']);

Route::get('/delete_product/{id}', [AdminController::class, 'delete_product']);

Route::get('/all_products', [HomeController::class, 'all_products']);

Route::get('/product_details/{id}', [HomeController::class, 'product_details']);
