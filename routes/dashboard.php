<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('admin')->get('/', function () {
    return view('dashboard.welcome');
})->name('welcome');

Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'show')->name('login.index');
    Route::post('/login', 'login')->name('login.post');
    Route::post('/logout', 'logout')->name('logout');
});

Route::middleware('admin')->resource('/products', ProductController::class)->except('show');

Route::middleware('admin')->resource('/categories', CategoryController::class)->except(['show', 'create']);

Route::middleware('admin')->get('/users', [UserController::class, 'index'])->name('users.index');

Route::middleware('admin')->resource('orders', OrderController::class)->only(['index', 'show', 'update']);
