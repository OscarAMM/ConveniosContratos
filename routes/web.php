<?php

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

/*Route::get('/', function () {
    return view('welcome');
});*/
Route::get('/registro_usuarios', 'UserController@create');
Auth::routes();

<<<<<<< HEAD
Route::get('/home', 'HomeController@index')->name('home');
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
=======
Route::get('/', 'HomeController@index')->name('home');

Route::get('/catalogue/{user?}',['middleware'=> 'adminCatalogue','uses' =>'catalogueController@index']);
>>>>>>> f0b74310e4529393751b792bd79ab9b25213fed3
