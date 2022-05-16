<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ImageController;
use App\Http\Controllers\Admin\ProductController;

Route::resource('users', App\Http\Controllers\Admin\UserController::class);
Route::delete('images/{image}', [ImageController::class, 'destroy'])->name('images.destroy');
Route::get('exports', function () {
    return view('admin.products.export');
});
Route::get('exporting', [ProductController::class, 'export'])->name('products.export');
Route::get('imports', function () {
    return view('admin.products.import');
});
Route::post('importing', [ProductController::class, 'import'])->name('products.import');
Route::resource('products', App\Http\Controllers\Admin\ProductController::class);
