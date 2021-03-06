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

Route::group(['prefix' => '/v1'], function() {
	Route::get('/customer', 'API\CustomerController@index');
	Route::get('/customer/{id}', 'API\CustomerController@show');
	Route::post('/customer/create', 'API\CustomerController@store');
	Route::post('/customer/edit/{id}', 'API\CustomerController@update');
	Route::get('/customer/delete/{id}','API\CustomerController@destroy');
	//Route for post
	Route::get('/post', 'API\PostController@getAllPost');
	Route::get('/post/{id}', 'API\PostController@getPostDetail');
	Route::post('/post/create', 'API\PostController@store');
	Route::get('/post/delete/{id}','API\PostController@destroy');
	Route::post('/post/edit/{id}', 'API\PostController@update');
	Route::get('/comment/{id_post}', 'API\PostController@getCommentsByPostID');
	Route::post('/comment/create', 'API\PostController@storeComment');
	Route::get('/comment/delete/{id}','API\PostController@destroyComment');
});
