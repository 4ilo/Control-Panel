<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::redirect('/','login');
Route::get('login', 'AuthController@login')->name('login');
Route::post('login', 'AuthController@authenticate')->name('authenticate');
Route::get('logout', 'AuthController@logout')->name('logout');

Route::get('home', 'DashboardController@home')->name('home');

// Output routes
Route::resource('output', 'OutputController', ['Except' => ['show','destroy']]);
Route::get('output/{output}/delete', 'OutputController@destroy')->name('output.destroy');
Route::get('output/{output}/enable', 'OutputController@enable')->name('output.enable');
Route::get('output/{output}/disable', "OutputController@disable")->name('output.disable');