<?php

Auth::routes();
Route::get('/', 'HomeController@index')->name('home');

//RUTA Persona
Route::resource('Person', 'PersonController');
//Ruta Convenio
Route::resource('Agreement', 'AgreementController');
Route::get('/AgreementPublic', ['uses' => 'AgreementController@indexPublic', 'as' => 'public.index']);
Route::get('/AgreementShow/{id}', ['uses' => 'AgreementController@showPublic', 'as' => 'public.show']);
Route::get('/AgreementIndexPersonal', ['uses' => 'AgreementController@index2', 'as' => 'Agreement.index2']);

Route::post('/autocomplete/fetch', 'AgreementController@fetch')->name('autocomplete.fetch');
Route::post('/autocomplete/fetchUsers', 'AgreementController@fetchUsers')->name('autocomplete.fetchUsers');
Route::post('/autocomplete/fetchInstruments', 'AgreementController@fetchInstruments')->name('autocomplete.fetchInstruments');
Route::get('/AgreementDownloadFile/{id}', ['as' => 'agreement.download', 'uses' => 'AgreementController@showfile']);
//RUTAS DE ADMIN
Route::get('/registerAdmin', ['as' => 'admin.index', 'uses' => 'RegisterAdminController@index']);
Route::post('/registerAdminCreate', ['as' => 'admin.create', 'uses' => 'RegisterAdminController@create']);
//RUTAS DE ROLES
Route::get('/registerAdminRoles', 'RegisterAdminController@change_roles');
Route::post('/registerAdminRolesChange', 'RegisterAdminController@AdminAssignRoles');
Route::resource('users', 'UserController');
Route::post('/usersEdited/{id}', ['as' => 'users.edited', 'uses' => 'UserController@edited']);
Route::get('/usersReset', ['as' => 'users.reset', 'uses' => 'UserController@reset']);
Route::post('/usersUpdate/{id}', ['as' => 'users.update', 'uses' => 'UserController@update']);
//RUTA MAIL
Route::get('/mail', ['uses'=> 'EmailController@index' , 'as' => 'mail.index']);
Route::post('send/sendmail', ['uses'=> 'EmailController@sendEmail' , 'as' => 'SendMail.index']);
//RUTA REVISION FORUM
Route::resource('revision', 'RevisionController');
Route::get('/RevisionAgreementForum/{id}',  ['uses'=> 'RevisionController@ForumAgreement' , 'as' => 'Forum.Agreement']);
Route::get('/Revision', ['uses' => 'RevisionController@showRevision', 'as' => 'Revision']);
Route::get('/Back', ['uses' => 'RevisionController@back', 'as' => 'Back']);

Route::get('/UserRevision',['uses' => 'RevisionController@UserRevision', 'as' => 'UserRevision']);
Route::get('/PublicRevisionAgreementForum/{id}',  ['uses'=> 'RevisionController@PublicForumAgreement' , 'as' => 'PublicForum.Agreement']);
//Ruta COMMENT
Route::resource('Comment', 'CommentController');
Route::post('/CommentAgreement/{id}',  ['uses'=> 'CommentController@commentAgreement' , 'as' => 'CommentAgreement.make']);
Route::post('/FinallyAgreement/{id}',  ['uses'=> 'CommentController@finallyAgreement' , 'as' => 'FinallyAgreement.notify']);
Route::get('/NotifyAgreement/{id}',  ['uses'=> 'CommentController@notifyAgreement' , 'as' => 'NotifyAgreement.users']);
//PDF ROUTE
Route::get('/dynamic_pdf', ['uses' => 'PDFController@index', 'as' => 'PrePDF']);
Route::get('/PDF', ['uses' => 'PDFController@downloadPDF', 'as' => 'PDFDownload'] );

Route::get('/RegistroFinal/{id}', ['uses' =>'FinalRegisterController@formIndex', 'as' => 'Register'] );
//Legal Instrument Route
Route::resource('LegalInstrument', 'LegalInstrumentController');
Route::get('/legalInstrument', ['uses' => 'LegalInstrumentController@storeModal', 'as' =>'newInstrument']);
//MODAL
Route::get('/PersonModal', ['uses' => 'PersonController@storeModal', 'as' =>'PersonModal']);
//FINAL REGISTER ROUTE
Route::resource('FinalRegister','FinalRegisterController');
Route::get('/FinalPersonModal',['uses' => 'PersonController@storeModalFinal','as' =>'FinalModal']);
Route::post('/FinalDocs', ['uses'=> 'FinalRegisterController@storeDocs', 'as' =>'FinalDocs']);
Route::get('/FinalDownloadFile/{id}', ['as' => 'document.download', 'uses' => 'FinalRegisterController@showfile']);
//DOCUMENT ROUTE
Route::get('/IndexReports', ['uses' => 'DocumentController@index', 'as' =>'Index']);
Route::get('/createDoc', ['uses' =>'DocumentController@create', 'as' =>'CreateDocs']);
Route::post('/storeDoc/{id}',['uses' =>'DocumentController@store', 'as' =>'StoreDocs']);
Route::post('/storeFinal/{id}',['uses' =>'DocumentController@storeFinal', 'as' =>'StoreFinal']);
Route::post('/storeComments/{id}',['uses' =>'DocumentController@storeComments', 'as' =>'StoreComments']);