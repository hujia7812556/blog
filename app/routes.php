<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/','IndexController@index');
Route::get('login','LoginController@index');
Route::post('login', array('before' => 'csrf', 'uses'=>'LoginController@store'));
Route::get('home', array('before' => 'auth', 'uses' => 'LoginController@showHome'));
Route::get('logout', array('before' => 'auth', function () {
    Auth::logout();
    return Redirect::to('/');
}));

Route::get('register', 'RegisterController@index');
Route::post('register', array('before' => 'csrf', 'uses' => 'RegisterController@store'));
Route::get('user/{id}/edit', array('before' => 'auth', 'as' => 'user.edit', 'uses' => 'UserController@edit'));
Route::put('user/{id}', array('before' => 'auth|csrf', 'uses' => 'UserController@update'));

Route::group(array('prefix' => 'admin', 'before' => 'auth|isAdmin'), function () {
    Route::get('users', 'AdminController@users');
    Route::get('articles', 'AdminController@articles');
    Route::get('tags', 'AdminController@tags');
});

Route::model('user', 'User');

Route::group(array('before' => 'auth|csrf|isAdmin'), function () {
    Route::put('user/{user}/reset', function (User $user) {
        $user->password = Hash::make('123456');
        $user->save();
        return Redirect::to('admin/users')->with('message', array('type' => 'success', 'content' => 'Reset password successfully'));
    });

    Route::delete('user/{user}', function (User $user) {
        $user->block = 1;
        $user->save();
        return Redirect::to('admin/users')->with('message', array('type' => 'success', 'content' => 'Lock user successfully'));
    });

    Route::put('user/{user}/unblock', function (User $user) {
        $user->block = 0;
        $user->save();
        return Redirect::to('admin/users')->with('message', array('type' => 'success', 'content' => 'Unlock user successfully'));
    });
});

Route::resource('article', 'ArticleController');
Route::post('article/preview', array('before' => 'auth', 'uses' => 'ArticleController@preview'));
Route::get('user/{user}/articles', 'UserController@articles');
Route::post('article/{id}/preview', array('before' => 'auth', 'uses' => 'ArticleController@preview'));
Route::resource('tag', 'TagController');
Route::get('tag/{id}/articles', 'TagController@articles');
Route::get('tag/list', array('as'=>'tag_list','uses'=>'TagController@show'));