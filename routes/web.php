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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', function () {
    return view('index');
});
Route::get('/post', function () {
    return view('post/post');
});
Route::get('/post/create', function () {
    return view('post/create');
});
Route::get('/post/edit/{id}', function ($id) {
    return view('post/edit')->with('id', $id);
});
Route::get('/post/view/{post_id}', function ($post_id) {
    return view('post/detail')->with('post_id', $post_id);
});