<?php

//This routes are set up in RouteServiceProvide.php

Route::get('/', 'TiposDeCargaCatalogController@index');
Route::get('/{tipoCargaId}', 'TiposDeCargaCatalogController@getById');
Route::post('/new', 'TiposDeCargaCatalogController@createNewTipoCarga');
Route::put('/update', 'TiposDeCargaCatalogController@updateTipoDeCarga');
Route::delete('/delete', 'TiposDeCargaCatalogController@deleteTipoDeCarga');
