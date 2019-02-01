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
Route::get('/','HomeController@index')->name('home');

<<<<<<< HEAD
Route::get('/', 'HomeController@index')->name('home');

Route::get('/catalogue/{user?}',['middleware'=> 'adminCatalogue','uses' =>'catalogueController@index']);
Route::resource('instituciones', 'InstitucionController');
=======
//Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
>>>>>>> 10579a00f8a18ad44ebefce8193f5ac86045efe0
