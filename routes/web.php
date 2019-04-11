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
Route::get('/RevisionContractForum/{id}',  ['uses'=> 'RevisionController@ForumContract' , 'as' => 'Forum.Contract']);
Route::get('/RevisionAgreementForum/{id}',  ['uses'=> 'RevisionController@ForumAgreement' , 'as' => 'Forum.Agreement']);
Route::get('/Revision', ['uses' => 'RevisionController@showRevision', 'as' => 'Revision']);
Route::get('/UserRevision',['uses' => 'RevisionController@UserRevision', 'as' => 'UserRevision']);
Route::get('/PublicRevisionContractForum/{id}',  ['uses'=> 'RevisionController@PublicForumContract' , 'as' => 'PublicForum.Contract']);
Route::get('/PublicRevisionAgreementForum/{id}',  ['uses'=> 'RevisionController@PublicForumAgreement' , 'as' => 'PublicForum.Agreement']);

//Ruta COMMENT
Route::resource('Comment', 'CommentController');
Route::post('/CommentAgreement/{id}',  ['uses'=> 'CommentController@commentAgreement' , 'as' => 'CommentAgreement.make']);
Route::post('/CommentContract/{id}',  ['uses'=> 'CommentController@commentContract' , 'as' => 'CommentContract.make']);
Route::post('/FinallyAgreement/{id}',  ['uses'=> 'CommentController@finallyAgreement' , 'as' => 'FinallyAgreement.notify']);
Route::post('/FinallyContract/{id}',  ['uses'=> 'CommentController@finallyContract' , 'as' => 'FinallyContract.notify']);
//PDF ROUTE
Route::get('/dynamic_pdf', 'PDFController@index');
Route::get('/dynamic_pdf/{id}', ['uses' => 'PDFController@downloadPDF', 'as' => 'PDFDownload'] );