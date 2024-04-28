<?php

use App\Http\Controllers\Admin\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard.products.create');
})->name('welcome');

Route::prefix('/dashboard')->name('admin.')->group(function () {
    Route::resource('/products', ProductController::class)->except('show');
});
