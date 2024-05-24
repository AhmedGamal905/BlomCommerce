<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;

Route::get('/', [ProductController::class, 'index'])->name('home');

Route::get('/category/{category}', [ProductController::class, 'categoryProducts'])->name('category.products');
Route::get('/product/{product}', [ProductController::class, 'details'])->name('product.details');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::controller(CartController::class)->prefix('cart')->name('cart.')->group(function () {
    Route::get('/', 'show')->name('show');
    Route::post('/store', 'store')->name('store');
    Route::post('/destroy', 'destroy')->name('destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/checkout', [OrderController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [OrderController::class, 'store'])->name('checkout.store');
    Route::get('/orders', [OrderController::class, 'history'])->name('order.history');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('order.show');
});



require __DIR__ . '/auth.php';
