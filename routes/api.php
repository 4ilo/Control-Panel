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


Route::apiResource('output', 'Api\OutputApiController');
Route::get('output/{output}/activate', 'Api\OutputApiController@activate');
Route::get('output/{output}/disable', 'Api\OutputApiController@disable');

Route::post('login', 'Api\OutputApiController@getAccessToken');