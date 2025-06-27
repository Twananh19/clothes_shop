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

Route::post('/add_to_cart', [HomeController::class, 'add_to_cart']);

Route::get('/cart', [HomeController::class, 'cart']);

Route::post('/remove_from_cart', [HomeController::class, 'remove_from_cart']);

Route::post('/update_cart', [HomeController::class, 'update_cart']);

Route::get('/get_cart_count', [HomeController::class, 'get_cart_count']);

Route::get('/checkout', [HomeController::class, 'checkout']);

Route::post('/process_payment', [HomeController::class, 'process_payment']);

Route::get('/payment_success', [HomeController::class, 'payment_success']);

Route::get('/payment_failed', [HomeController::class, 'payment_failed']);
