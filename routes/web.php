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
Route::get('/stream/{showAll}', 'StreamController@showAll')->name('streamAll');
Route::get('/stream', 'StreamController@index')->name('stream');

//Profiles and Follows
Route::get('/user/{userId}', [
  'uses' => 'ProfileController@index',
  'as' => 'show.profile',
  'middleware' => 'auth'
]);

Route::get('/follow/{followedId}', [
  'uses' => 'FollowController@follow',
  'as' => 'follow.user',
  'middleware' => 'auth'
]);

Route::get('/unfollow/{followedId}', [
  'uses' => 'FollowController@unfollow',
  'as' => 'unfollow.user',
  'middleware' => 'auth'
]);

//Publications
Route::get('/posts/{userNickname}/{postId}', [
  'uses' => 'PostController@index',
  'as' => 'show.post',
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

//Comments
Route::post('/addcomment', [
  'uses' => 'CommentController@addComment',
  'as' => 'add.comment',
  'middleware' => 'auth'
]);

Route::post('/deletecomment', [
  'uses' => 'CommentController@deleteComment',
  'as' => 'delete.comment',
  'middleware' => 'auth'
]);

//Likes
Route::get('/like/{postId}', [
  'uses' => 'LikeController@addLike',
  'as' => 'add.like',
  'middleware' => 'auth'
]);

Route::get('/unlike/{postId}', [
  'uses' => 'LikeController@removeLike',
  'as' => 'remove.like',
  'middleware' => 'auth'
]);
