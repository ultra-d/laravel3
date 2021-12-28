<?php

use Illuminate\Support\Facades\Route;

Route::get('/admin/users', [UserController::class, 'index'])->name('admin.index')->middleware('is_admin');

Route::prefix('admin')->name('admin.')->group(function(){
    Route::get('/', function(){
        return view('admin.flag');
        })->middleware('is_admin');
});