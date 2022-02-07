<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;

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
Route::get('/landing', 'App\Http\Controllers\SearchController@index')->middleware(['auth', 'verified']);

Route::view('/contact', 'contact')->name('contact')->middleware(['auth', 'verified']);
Route::post('/contact', 'App\Http\Controllers\MessageController@store')->name('messages.store');
