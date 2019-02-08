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


Auth::routes();
Route::get('/','HomeController@index')->name('home');
//Ruta Institute
Route::resource('Institute','InstituteController');



//RUTAS DE ADMIN
Route::get('/registerAdmin','RegisterAdminController@index');
Route::post('/registerAdminCreate','RegisterAdminController@create');
//RUTAS DE ROLES
Route::get('/registerAdminRoles','RegisterAdminController@change_roles');
Route::post('/registerAdminRolesChange','RegisterAdminController@AdminAssignRoles');
;

Route::resource('users', 'UserController');





