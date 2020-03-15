<?php

Route::post('/login', 'AuthController@loginUser');
Route::post('/logout', 'AuthController@logoutUser');
Route::middleware('auth:api')->get('/infoFromToken', 'AuthController@getUserInfo');

