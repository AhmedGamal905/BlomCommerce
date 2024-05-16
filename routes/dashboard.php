<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use Illuminate\Support\Facades\Route;

Route::middleware('admin')->get('/', function () {
    return view('dashboard.welcome');
})->name('welcome');

Route::middleware('admin')->resource('/products', ProductController::class)->except('show');

Route::middleware('admin')->resource('/categories', CategoryController::class)->except(['show', 'create']);

Route::get('/login', [AuthController::class, 'displayLogin'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
