
<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::post('register', 'Auth\RegisterController');
    Route::post('login', 'Auth\LoginController');
    Route::get('refresh', 'AuthConstroller@refresh');

    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('profile', 'User\ProfileController@me');
        Route::get('profile/{username}', 'User\ProfileController');
        Route::post('logout', 'Auth\LogoutController');
        Route::post('profile/update/avatar','User\ProfileController@updateAvatar'); 
        Route::post('profile/update/cover','User\ProfileController@updateCover'); 
        Route::get('posts', 'Post\PostController@index')->withoutMiddleware('auth');
        Route::get('posts/last/{value}', 'Post\PostController@lastPostUser');
        Route::get('posts/create', 'Post\PostController@create');
        Route::post('posts/store', 'Post\PostController@store');
        Route::get('posts/{post:id}/edit', 'Post\PostController@edit');
        Route::patch('posts/{post:id}/edit', 'Post\PostController@update');
        Route::delete('posts/{post:id}/delete', 'Post\PostController@destroy');
        Route::get('posts/{post:id}', 'Post\PostController@show')->withoutMiddleware('auth');
        
    });
});
