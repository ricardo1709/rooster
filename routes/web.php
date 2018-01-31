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

Route::get('/', 'RoosterController@my')->middleware('auth');
Route::get('/student/{user}', 'RoosterController@show')->middleware('auth');
Route::get('/amoclient/ready', 'RoosterController@my')->middleware('auth');