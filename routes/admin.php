<?php

use Illuminate\Support\Facades\Route;

Route::resource('users', App\Http\Controllers\Admin\UserController::class);

Route::resource('products', App\Http\Controllers\Admin\ProductController::class);
