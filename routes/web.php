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
<<<<<<< HEAD
=======
//Route::get('/registro_usuarios', 'UserController@create');
>>>>>>> b2c39b695ebf3048e3623f05d2ebd39ce4fbc44e
Auth::routes();
Route::get('/','HomeController@index')->name('home');
Route::get('/Institutes','InstituteController@index');

<<<<<<< HEAD

=======
>>>>>>> b2c39b695ebf3048e3623f05d2ebd39ce4fbc44e
