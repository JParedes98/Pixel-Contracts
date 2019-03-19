<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/contrato/nuevo/cliente', 'ContractController@newCustomer')->name('nuevo.cliente');
Route::get('/contrato/nuevo/{key}', 'ContractController@create')->name('contrato.nuevo');

Route::get('/contrato/editar/{id}', 'ContractController@edit')->name('contrato.editar');

Route::get('/contrato/consolidacion/{rtn}', 'ContractController@preview')->name('contrato.preview');
Route::get('contrato/consolidado', 'ContractController@preview');
Route::get('/contrato/pdf/{rtn}', 'ContractController@pdf')->name('contrato.pdf');

Route::post('/contrato/nuevo-cliente', 'ContractController@createCustomer')->name('guardar.cliente');
Route::post('/contrato/actualizar/{id}', 'ContractController@update')->name('contrato.actualizar');
Route::post('/contratos', 'ContractController@store')->name('contrato.insertar');
Route::post('/contrato/completado', 'ContractController@setStatusComplete')->name('contrato.consolidacion');