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
//Ruta DEPENDENCIA
Route::resource('Dependence', 'DependenceController');

//RUTAS DE ADMIN
Route::get('/registerAdmin',["as"=>"admin.index","uses"=>'RegisterAdminController@index']);
Route::post('/registerAdminCreate',["as"=>"admin.create","uses"=>'RegisterAdminController@create']);
//RUTAS DE ROLES
Route::get('/registerAdminRoles','RegisterAdminController@change_roles');
Route::post('/registerAdminRolesChange','RegisterAdminController@AdminAssignRoles');


//Route::post('/registerAdminRolesChange7{{$id}}','RegisterAdminController@AdminAssignRoles');
//Route::get('/usersview/{id}',["as" => "users.view","uses" => "RegisterAdminController@AdminAssignRoles"]);
Route::resource('users', 'UserController');

Route::post('/usersEdited/{id}',["as" => "users.edited","uses" => "UserController@edited"]);





