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
    return view('home2');
})->name('home');

Route::get('saludo/{nombre?}', function($nombre = "Invitado"){
	return "Saludos, don chimbo " . $nombre;
});
Route::view('/about', 'about')->name('about');

Route::resource('portfolio', 'App\Http\Controllers\ProjectController')
	->names('projects')
	->parameters(['portfolio' => 'project'])->middleware(['auth', 'verified']);

Route::view('/contact', 'contact')->name('contact');

Route::post('contact', 'App\Http\Controllers\MessageController@store')->name('messages.store');

Route::prefix('admin')->name('admin.')->group(function(){
	Route::resource('/users', 'App\Http\Controllers\Admin\UserController');
});