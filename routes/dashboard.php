<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;

Route::middleware('admin')->get('/', function () {
    return view('dashboard.welcome');
})->name('welcome');

Route::get('/login', [AuthController::class, 'displayLogin'])->name('login.index');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('admin')->resource('/products', ProductController::class)->except('show');
Route::middleware('admin')->resource('/categories', CategoryController::class)->except(['show', 'create']);

Route::middleware('admin')->group(function () {
    Route::get('/orders', [OrderController::class, 'index'])->name('order.index');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('order.show');
});
