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

Route::group(['middleware' => ['web']], function () {

    Route::get('/', function () {
        return view('welcome');
    });


    /* CPNS */
    Route::get('/cpns', function () {
	    return view('welcome');
	});
	Route::get('/api/v1/cpns/getAll/', 'CPNSController@getAllCPNS');
	Route::get('/api/v1/cpns/get/{nik}', 'CPNSController@getCPNS');
	Route::post('/api/v1/cpns/add', 'CPNSController@addCPNS');
	Route::post('/api/v1/cpns/get/{nik}', 'CPNSController@editCPNS');
	Route::delete('/api/v1/cpns/get/{nik}', 'CPNSController@deleteCPNS');

});
