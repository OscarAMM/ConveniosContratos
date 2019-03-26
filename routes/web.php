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
Route::get('/AgreementPublic', ['uses' => 'AgreementController@indexPublic', 'as' => 'public.index']);
Route::get('/AgreementShow/{id}', ['uses' => 'AgreementController@showPublic', 'as' => 'public.show']);

//RUTAS DE ADMIN
Route::get('/registerAdmin', ['as' => 'admin.index', 'uses' => 'RegisterAdminController@index']);
Route::post('/registerAdminCreate', ['as' => 'admin.create', 'uses' => 'RegisterAdminController@create']);

//RUTAS DE ROLES
Route::get('/registerAdminRoles', 'RegisterAdminController@change_roles');
Route::post('/registerAdminRolesChange', 'RegisterAdminController@AdminAssignRoles');
Route::resource('users', 'UserController');
Route::post('/usersEdited/{id}', ['as' => 'users.edited', 'uses' => 'UserController@edited']);

//RUTA MAIL
Route::get('/mail', ['uses'=> 'EmailController@index' , 'as' => 'mail.index']);
Route::post('send/sendmail', ['uses'=> 'EmailController@sendEmail' , 'as' => 'SendMail.index']);
//RUTA REVISION FORUM
Route::get('/RevisionForum',  ['uses'=> 'AgreementController@ForumRevision' , 'as' => 'Forum.Revision']);