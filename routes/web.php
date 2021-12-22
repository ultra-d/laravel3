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

/*Route::get('/portafolio', 'ProjectController@index')->name('projects.index');

Route::get('/portafolio/crear', 'ProjectController@create')->name('projects.create');

Route::post('/portafolio', 'ProjectController@store')->name('projects.store');

Route::get('/portafolio/{project}', 'ProjectController@show')->name('projects.show');

Route::get('/portafolio/{project}/editar', 'ProjectController@edit')->name('projects.edit');

Route::patch('/portafolio/{project}', 'ProjectController@update')->name('projects.update');

Route::delete('/portafolio/{project}', 'ProjectController@destroy')->name('projects.destroy');*/

Route::view('/contact', 'contact')->name('contact');

Route::post('contact', 'App\Http\Controllers\MessageController@store')->name('messages.store');