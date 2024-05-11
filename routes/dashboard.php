<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;

Route::middleware('admin')->get('/', function () {
    return view('dashboard.welcome');
})->name('welcome');

Route::middleware('admin')->resource('/products', ProductController::class)->except('show');

Route::middleware('admin')->resource('/categories', CategoryController::class)->except(['show', 'create']);

Route::get('/login', [AdminController::class, 'displayLogin'])->name('login.form');
Route::post('/login', [AdminController::class, 'login'])->name('login.post');
Route::post('/logout', [AdminController::class, 'logout'])->name('logout');
