<?php

// Route::view('/', 'welcome');

Auth::routes();
Route::get('/', 'ContractController@index')->name('index');

Route::view('/contrato/nuevo/cliente', 'new-customer')->name('new-customer');
Route::get('/contrato/nuevo/{key}', 'ContractController@create')->name('create');

Route::get('/contrato/editar/{id}', 'ContractController@editContract')->name('editContract');
Route::get('/contrato/consolidacion/{id}', 'ContractController@previewCompleted')->name('contrato.preview');
Route::get('/contrato/consolidado', 'ContractController@previewCompleted');
Route::get('/contrato/pdf/{rtn}', 'ContractController@pdf')->name('contrato.pdf');

Route::post('/contrato/nuevo-cliente', 'ContractController@createCustomer')->name('guardar.cliente');
Route::post('/contrato/actualizar/{id}', 'ContractController@update')->name('contrato.actualizar');
Route::post('/contratos', 'ContractController@store')->name('contrato.insertar');
Route::post('/contrato/completado', 'ContractController@setStatusComplete')->name('contrato.consolidacion');