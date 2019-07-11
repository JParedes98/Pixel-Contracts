<?php
// Route::view('/', 'welcome');

Auth::routes();
Route::get('/', 'ContractController@index')->name('index');
Route::get('/contrato/nuevo/cliente', 'ContractController@newCustomer')->name('new-customer');
Route::get('/contrato/nuevo/{key}', 'ContractController@newContract')->name('new-contract');
Route:: get('/contrato/adjuntar', 'ContractController@getAttachView')->name('attach-contract');
Route::get('/contrato/consolidacion/{key}', 'ContractController@previewCompleted')->name('contract-preview');
Route::get('/contrato/consolidado', 'ContractController@previewCompleted');
// Route::get('/contrato/pdf/{rtn}', 'ContractController@pdf')->name('contrato.pdf');
Route::get('/contrato/editar/{id}', 'ContractController@editContract')->name('edit-contract');

Route::get('contrato/{id}', 'ContractController@getContract')->name('get-contract');
Route::get('contrato/ver-anexos/{id}', 'ContractController@getOnceContractAttachments')->name('get-once-contract-attachments');
Route::get('contrato/anexos/{id}', 'ContractController@getContractAttachments')->name('get-contract-attachments');

Route::post('/contrato/nuevo-cliente', 'ContractController@createCustomer')->name('create-customer');
Route::post('/contratos', 'ContractController@store')->name('store-contract');
Route::post('/contrato/adjuntar', 'ContractController@uploadContract')->name('upload-Contract');
Route::post('/contrato/completado', 'ContractController@setStatusComplete')->name('contract-consolidated');
Route::post('/contrato/actualizar/{id}', 'ContractController@update')->name('update-contract');
Route::post('/contrato/eliminar', 'ContractController@delete')->name('delete-contract');

Route::get('/recreate/pdf/{id}', 'ContractController@recreatePdf')->name('recreate-pdf');