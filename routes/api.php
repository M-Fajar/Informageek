<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::post('register', 'Auth\RegisterController');
    Route::post('login', 'Auth\LoginController');
    Route::get('refresh', 'AuthConstroller@refresh');
    

    Route::group(['middleware' => 'auth:api'], function(){
        Route::get('profile', 'User\ProfileController@me');
        Route::get('profile/{username}', 'User\ProfileController');
        Route::post('logout', 'Auth\LogoutController');
    });
});