<?php

//This routes are set up in RouteServiceProvide.php

Route::get('/', 'TiroController@index');
Route::get('/{tipoCargaId}', 'TiroController@getById');
Route::post('/new', 'TiroController@createNewTiro');
Route::put('/update', 'TiroController@updateTiro');
Route::delete('/delete', 'TiroController@deleteTiro');
Route::post('/upload', 'TiroController@uploadEvidenciaToTiro');
