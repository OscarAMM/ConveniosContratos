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
<<<<<<< HEAD
=======
Route::post('/registerAdminRolesChange','RegisterAdminController@AdminAssignRoles');


>>>>>>> 187f391d06fb21f113d94e2f1844beb920d0b7d3
//Route::post('/registerAdminRolesChange7{{$id}}','RegisterAdminController@AdminAssignRoles');
//Route::get('/usersview/{id}',["as" => "users.view","uses" => "RegisterAdminController@AdminAssignRoles"]);
Route::resource('users', 'UserController');

Route::post('/usersEdited/{id}',["as" => "users.edited","uses" => "UserController@edited"]);





