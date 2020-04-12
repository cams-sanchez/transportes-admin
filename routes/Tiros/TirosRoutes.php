<?php

//This routes are set up in RouteServiceProvide.php

Route::get('/', 'TiroController@index');
Route::get('/delivery/{deliveryNumber}', 'TiroController@getByDelivery');
Route::post('/new', 'TiroController@createNewTiro');
Route::put('/update', 'TiroController@updateTiro');
Route::delete('/delete', 'TiroController@deleteTiro');
Route::post('/upload', 'TiroController@uploadEvidenciaToTiro');
Route::post('/excel', 'TiroController@uploadExcel');
Route::get('/byDateRange/{startDate}/{endDate}', 'TiroController@tirosByDateRange');
Route::get('/byViaje/{viajeId}', 'TiroController@tirosByViaje');
Route::get('/byCiudad/{ciudad}', 'TiroController@tirosByCiudad');
