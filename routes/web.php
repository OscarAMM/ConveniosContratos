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
//Route::get('/registro_usuarios', 'UserController@create');
Auth::routes();
Route::get('/','HomeController@index')->name('home');
Route::get('/Institutes','InstituteController@index');
//Route::get('/registerAdmin','RegisterAdminController@create');
Route::get('/registerAdmin','RegisterAdminController@index');
Route::post('/registerAdminCreate','RegisterAdminController@create');



