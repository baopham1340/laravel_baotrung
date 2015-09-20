<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('/', function()
    {
    	return 'welcom';
    });
Route::get('/a', function()
    {
    	return 'a';
    });

Route::resource('login.password', 'LoginController',['only' => ['show']]);
Route::resource('user', 'UserController');

Route::get('lhbs/apikey/{api_key}','LHBSController@getLHBSbyApiKey');
Route::resource('lhbs', 'LHBSController');