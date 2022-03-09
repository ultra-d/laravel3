<?php

use App\Http\Controllers\Admin\ImageController;
use Illuminate\Support\Facades\Route;

Route::resource('users', App\Http\Controllers\Admin\UserController::class);
Route::delete('images/{image}', [ImageController::class, 'destroy'])->name('images.destroy');
Route::resource('products', App\Http\Controllers\Admin\ProductController::class);
