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
Route::get('/about_us', function(){
    return view('pages.about_us');
});

// News
//Route::get('news', 'NewsController@list');
Route::get('news/{id}', 'NewsController@show');
Route::get('rte', 'NewsController@rte');
Route::get('/rte/{id}', 'NewsController@edit');


// User
Route::get('profile/{id}', 'UserController@show')->name('profile');
Route::post('edit_profile/{id}','UserController@edit')->name('edit_profile');
Route::delete('/api/delete_profile/{id}','UserController@delete')->name('delete_user');
Route::post('/api/edit_profile_api/{id}','UserController@update')->name('edit_profile_api');
Route::post('change_admin/{id}','UserController@change_admin')->name('change_admin');
Route::post('/api/follow', 'UserController@follow');
Route::delete('/api/unfollow', 'UserController@unfollow');
Route::get('/follow_list/{id}', 'UserController@follow_list');

// API
Route::post('/api/news', 'NewsController@create')->name('create_news');
Route::delete('api/news/{news_id}', 'NewsController@delete')->name('delete_news');
Route::post('api/news/update', 'NewsController@update')->name('update_news');
Route::post('api/new_comment', 'CommentController@create')->name('new_comment');
Route::post('api/del_comment', 'CommentController@delete')->name('del_comment');
Route::post('api/edit_comment', 'CommentController@edit')->name('edit_comment');
Route::post('api/getReplies', 'CommentController@getReplies')->name('get_replies');
Route::post('/api/createReply', 'CommentController@createReply')->name('create_reply');
Route::post('api/editReply', 'CommentController@editReply')->name('edit_reply');
Route::delete('/api/delReply', 'CommentController@delReply')->name('del_reply');
Route::post('/api/vote/newsCreate', 'VoteController@newsCreate');
Route::post('/api/vote/newsUpdate', 'VoteController@newsUpdate');
Route::delete('/api/vote/newsDelete', 'VoteController@newsDelete');
Route::post('/api/vote/commentCreate', 'VoteController@commentCreate');
Route::post('/api/vote/commentUpdate', 'VoteController@commentUpdate');
Route::delete('/api/vote/commentDelete', 'VoteController@commentDelete');
/*Route::put('api/cards/{card_id}/', 'ItemController@create');
Route::post('api/item/{id}', 'ItemController@update');
Route::delete('api/item/{id}', 'ItemController@delete');*/

// Authentication
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// Mailing
Route::get('/welcome_email', 'EmailController@welcome');
