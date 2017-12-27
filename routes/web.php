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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/stream', 'StreamController@index')->name('stream');


//Posts
Route::get('/posts/{userNickname}/{postId}', [
  'uses' => 'PostController@index',
  'as' => 'show.postpage',
  'middleware' => 'auth'
]);

Route::post('/addpost', [
  'uses' => 'PostController@addPost',
  'as' => 'add.post',
  'middleware' => 'auth'
]);

Route::post('/editpost', [
  'uses' => 'PostController@editPost',
  'as' => 'edit.post',
  'middleware' => 'auth'
]);

Route::post('/deletepost', [
  'uses' => 'PostController@deletePost',
  'as' => 'delete.post',
  'middleware' => 'auth'
]);
