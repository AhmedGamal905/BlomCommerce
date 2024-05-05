<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard.products.create');
})->name('welcome');

Route::resource('/products', ProductController::class)->except('show');

Route::resource('/categories', CategoryController::class)->except(['show', 'create']);
