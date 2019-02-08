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
Route::post('/registerAdminRolesChange','RegisterAdminController@AdminAssignRoles');
;

=======
//Route::post('/registerAdminRolesChange7{{$id}}','RegisterAdminController@AdminAssignRoles');
//Route::get('/usersview/{id}',["as" => "users.view","uses" => "RegisterAdminController@AdminAssignRoles"]);
>>>>>>> 0d8c05a553f39f01da1d8fbc6890401c74a5dfcd
Route::resource('users', 'UserController');

Route::post('/usersEdited/{id}',["as" => "users.edited","uses" => "UserController@edited"]);





