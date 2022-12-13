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
// Home
Route::get('/', 'NewsController@list');
Route::get('/search', 'SearchController@search')->name('search');

// News
//Route::get('news', 'NewsController@list');
Route::get('news/{id}', 'NewsController@show');
Route::get('rte', 'NewsController@rte');

// User
Route::get('profile/{id}', 'UserController@show')->name('profile');
Route::post('edit_profile/{id}','UserController@edit')->name('edit_profile');
Route::post('delete_profile/{id}','UserController@delete')->name('delete_user');
Route::post('api/edit_profile/{id}','UserController@update')->name('edit_profile_api');
Route::post('change_admin/{id}','UserController@change_admin')->name('change_admin');


// API
Route::post('api/news', 'NewsController@create')->name('create_news');
Route::post('api/news/{news_id}', 'NewsController@delete')->name('delete_news');
Route::post('api/news/update/{news_id}', 'NewsController@update')->name('update_news');
Route::post('api/new_comment', 'CommentController@create')->name('new_comment');
Route::post('api/del_comment', 'CommentController@delete')->name('del_comment');
Route::post('api/edit_comment', 'CommentController@edit')->name('edit_comment');
Route::post('api/getReplies', 'CommentController@getReplies')->name('get_replies');
/*Route::put('api/cards/{card_id}/', 'ItemController@create');
Route::post('api/item/{id}', 'ItemController@update');
Route::delete('api/item/{id}', 'ItemController@delete');*/

// Authentication
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');
