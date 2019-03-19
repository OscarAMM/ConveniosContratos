<?php

Auth::routes();
Route::get('/', 'HomeController@index')->name('home');

//Ruta Institute
Route::resource('Institute', 'InstituteController');

//Ruta DEPENDENCIA
Route::resource('Dependence', 'DependenceController');

//Ruta contrato
Route::resource('Contract', 'ContractController');
Route::get('/ContractDownloadFile/{id}', ['as' => 'contract.download', 'uses' => 'ContractController@showfile']);
Route::get('/AgreementDownloadFile/{id}', ['as' => 'agreement.download', 'uses' => 'AgreementController@showfile']);

//Ruta Convenio
Route::resource('Agreement', 'AgreementController');
Route::get('/AgreementRevision', ['uses' => 'AgreementController@showRevision', 'as' => 'Revision']);

//RUTAS DE ADMIN
Route::get('/registerAdmin', ['as' => 'admin.index', 'uses' => 'RegisterAdminController@index']);
Route::post('/registerAdminCreate', ['as' => 'admin.create', 'uses' => 'RegisterAdminController@create']);

//RUTAS DE ROLES
Route::get('/registerAdminRoles', 'RegisterAdminController@change_roles');
Route::post('/registerAdminRolesChange', 'RegisterAdminController@AdminAssignRoles');
Route::resource('users', 'UserController');
Route::post('/usersEdited/{id}', ['as' => 'users.edited', 'uses' => 'UserController@edited']);

//RUTA MAIL
Route::get('/mail', 'EmailController@index');
Route::post('send/mail', 'EmailController@sendEmail');
