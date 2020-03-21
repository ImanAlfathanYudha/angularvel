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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
// Route::get('/customer', 'API\CustomerController@index');
Route::group(['prefix' => '/v1'], function() {
	Route::get('/customer', 'API\CustomerController@index');
	Route::get('/customer/{id}', 'API\CustomerController@show');
	Route::post('/customer/create', 'API\CustomerController@store');
	Route::post('/customer/edit/{id}', 'API\CustomerController@update');
	Route::get('/customer/delete/{id}','API\CustomerController@destroy');
	//Route for post
	
});
