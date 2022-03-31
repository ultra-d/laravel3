<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Shop\CartController;
use App\Http\Controllers\Shop\PaymentController;
use App\Http\Controllers\Customer\CustomerController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    return view('home');
})->name('home')->middleware(['auth', 'verified']);

Route::get('/search', 'App\Http\Controllers\SearchController@search');
Route::get('/landing', 'App\Http\Controllers\SearchController@index')
        ->middleware(['auth', 'verified'])
        ->name('landing');

Route::view('/contact', 'contact')->name('contact')->middleware(['auth', 'verified']);
Route::post('/contact', 'App\Http\Controllers\MessageController@store')->name('messages.store');

//Cart Route
Route::post('/cart', [CartController::class, 'store'])->name('shop.cart.store');
Route::get('/cart', [CartController::class, 'index'])->name('shop.cart.index')->middleware(['auth', 'verified']);
Route::delete('/cart/{cart}', [CartController::class, 'destroy'])->name('shop.cart.destroy');

Route::post('/payment/session', [PaymentController::class, 'createSession'])
    ->name('payment.create.session');

//Customer Route
Route::get('/profile', [CustomerController::class, 'index'])->name('customer.profile.index');
