<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ImageController;
use App\Http\Controllers\Admin\ProductController;

Route::resource('users', App\Http\Controllers\Admin\UserController::class);
Route::delete('images/{image}', [ImageController::class, 'destroy'])->name('images.destroy');
Route::resource('products', App\Http\Controllers\Admin\ProductController::class);
Route::get('products/exports', [ProductController::class, 'export'])->name('products.export');
Route::post('products/imports', [ProductController::class, 'import'])->name('products.import');
