<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/loginUser', 'AuthController@loginUser');
Route::post('/logoutUser', 'AuthController@logoutUser');
Route::middleware('auth:api')->get('/infoFromToken', 'AuthController@getUserInfo');

