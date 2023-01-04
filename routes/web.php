<?php

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\User;

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
Route::get('/', 'NewsController@List'); //v
Route::get('/following', 'NewsController@userFeedList'); //v
Route::get('/search', 'SearchController@search')->name('search'); //v
Route::get('/about_us', function(){ //v
    return view('pages.about_us');
});

// News
Route::get('news/{id}', 'NewsController@show'); //v
Route::get('rte', 'NewsController@rte'); //v
Route::get('/rte/{id}', 'NewsController@edit'); //v

// User
Route::get('profile/{id}', 'UserController@show')->name('profile'); //v
Route::post('edit_profile/{id}','UserController@edit')->name('edit_profile'); //v
Route::delete('/api/delete_profile/{id}','UserController@delete')->name('delete_user'); //v
Route::post('/api/edit_profile_api/{id}','UserController@update')->name('edit_profile_api'); //v
Route::post('change_admin/{id}','UserController@change_admin')->name('change_admin'); //v
Route::post('/api/follow', 'UserController@follow'); //v
Route::delete('/api/unfollow', 'UserController@unfollow'); //v
Route::get('/follow_list/{id}', 'UserController@follow_list'); //v

// API
Route::post('/api/news', 'NewsController@create')->name('create_news'); //v
Route::delete('api/news/{news_id}', 'NewsController@delete')->name('delete_news'); //v
Route::post('api/news/update', 'NewsController@update')->name('update_news'); //v
Route::post('api/new_comment', 'CommentController@create')->name('new_comment'); //v
Route::post('api/del_comment', 'CommentController@delete')->name('del_comment'); //v
Route::post('api/edit_comment', 'CommentController@edit')->name('edit_comment'); //v
Route::post('api/getReplies', 'CommentController@getReplies')->name('get_replies'); //v
Route::post('/api/createReply', 'CommentController@createReply')->name('create_reply'); //v
Route::post('api/editReply', 'CommentController@editReply')->name('edit_reply'); //v
Route::delete('/api/delReply', 'CommentController@delReply')->name('del_reply'); //v
Route::post('/api/vote/newsCreate', 'VoteController@newsCreate'); //v
Route::post('/api/vote/newsUpdate', 'VoteController@newsUpdate'); //v
Route::delete('/api/vote/newsDelete', 'VoteController@newsDelete'); //v
Route::post('/api/vote/commentCreate', 'VoteController@commentCreate'); //v
Route::post('/api/vote/commentUpdate', 'VoteController@commentUpdate'); //v
Route::delete('/api/vote/commentDelete', 'VoteController@commentDelete'); //v
Route::post('/api/tag/propose', 'TagController@createProposal'); //v
Route::post('/api/tag/create', 'TagController@createTag'); //v

// Authentication
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login'); //v
Route::post('login', 'Auth\LoginController@login'); //v
Route::get('logout', 'Auth\LoginController@logout')->name('logout'); //v
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register'); //v
Route::post('register', 'Auth\RegisterController@register'); //v
Route::get('/recover', 'UserController@recoverPassword'); //v

// Mailing
Route::get('/welcome_email', 'EmailController@welcome'); //v
Route::get('/recover_password', 'EmailController@recover'); //v

//notifications
Route::post('/api/sendnotifications', function(Request $request){
    if (!Auth::check()) return response('Unauthorized', 401);
    $user = User::find($request->input('user_id'));
    $username = $user->username;

    if($request->input('type')=='comment'){
        $comment = Comment::find($request->input('id'));
        $id_news = $comment->id_news;
    }
    else{
        $id_news = $request->input('id');
    }
    $arr = array(
        'id_comment' => $request->input('id'),
        'id_news' => $id_news,
        'type' => $request->input('type'),
        'user_id' => $request->input('user_id'),
        'user_name' => $username,
        'receiver_id' =>$request->input('receiver_id')
    );

    event(new App\Events\myEvent(json_encode($arr)));
    return response('Notification Sent', 200);

});

//Tag
Route::get('tag/{id}', 'TagController@show')->name('tag');
Route::post('/api/follow_tag', 'TagController@follow_tag');
Route::delete('/api/unfollow_tag', 'TagController@unfollow_tag');

//Admin
//Route::delete('/api/delete_tag/{id}','TagController@delete')->name('delete_tag');
Route::get('/admin', 'AdminController@show')->name('show_admin');
Route::post('/admin/revoke/{id}', 'UserController@change_admin')->name('revoke');
