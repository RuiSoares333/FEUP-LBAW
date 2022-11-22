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
Route::get('/search', 'NewsController@search')->name('search');

// News
//Route::get('news', 'NewsController@list');
Route::get('news/{id}', 'NewsController@show');

// User
Route::get('profile/{id}', 'UserController@show')->name('profile');
Route::get('edit_profile/{id}','UserController@edit')->name('edit_profile');

// API
Route::post('api/news', 'NewsController@create')->name('create_news');
Route::post('api/news/{news_id}', 'NewsController@delete')->name('delete_news');
Route::post('api/news/write', 'NewsController@writeNewsPost');
/*Route::put('api/cards/{card_id}/', 'ItemController@create');
Route::post('api/item/{id}', 'ItemController@update');
Route::delete('api/item/{id}', 'ItemController@delete');*/

// Authentication
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');
