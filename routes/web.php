<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Shop\CartController;
use App\Http\Controllers\Shop\PaymentController;
use App\Http\Controllers\Customer\InvoiceController;
use App\Http\Controllers\Customer\CustomerController;
use App\Http\Controllers\Customer\DashboardController;

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

//Dashboard
Route::get('/items/search', [DashboardController::class, 'search'])->name('dash.search');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dash.index');

Route::view('/contact', 'contact')->name('contact')->middleware(['auth', 'verified']);
Route::post('/contact', 'App\Http\Controllers\MessageController@store')->name('messages.store');

//Cart Route
Route::post('/cart', [CartController::class, 'store'])->name('shop.cart.store');
Route::get('/cart', [CartController::class, 'index'])->name('shop.cart.index')->middleware(['auth', 'verified']);
Route::delete('/cart/{cart}', [CartController::class, 'destroy'])->name('shop.cart.destroy');
Route::post('/cart/checkout', [CartController::class, 'checkoutSession'])
    ->name('shop.cart.checkout');


Route::get('/invoices/{reference}', [InvoiceController::class, 'show'])->name('customer.invoices.show')
    ->middleware(['auth', 'verified']);
Route::get('/invoices', [InvoiceController::class, 'index'])->name('customer.invoices.index')
    ->middleware(['auth', 'verified']);
//Invoice PDF
Route::get('/pdf/{reference}', [InvoiceController::class, 'pdf'])->name('customer.invoices.pdf')
    ->middleware(['auth', 'verified']);
