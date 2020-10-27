<?php

use Illuminate\Support\Facades\Route;

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

//Route Frontend
Route::get('/{any}', function () {
    return view('welcome');
})->where('any', '.*');

//Route Backend

// Auth::routes();


Route::group(['middleware'=>['auth','checkRole:admin'],'prefix'=>'admin'],function(){
    
    Route::get('/', 'Admin\HomeController@index')->name('admin');
    Route::get('/user', 'Admin\UserController@index')->name('admin.user');    
});
Route::group(['middleware'=>['auth','checkRole:user,userplus']],function(){
    Route::get('profile/{req}', 'User\UserController@detail')->name('user.detail');
});

Route::group(['prefix'=>'/message', 'middleware'=>['auth', 'checkRole:user,userplus'], 'as' => 'message'], function () {
	Route::get('/', 'User\MessageController@index');
	Route::get('chat/{room}', 'User\MessageController@fetchMessage')->name('.chat');
	Route::post('send', 'User\MessageController@sendMessage')->name('.send-message');

	Route::get('room', 'User\MessageController@fetchroom')->name('.room');
	Route::get('room/create', 'User\RoomController@create')->name('.room.create');
	Route::post('room/store', 'User\RoomController@store')->name('.room.store');
});
// Route::get('/home', 'HomeController@index')->name('home');

// Route::group(['middleware'=>['auth','checkRole:admin'],'prefix'=>'admin'],function(){
    
//     Route::get('/', 'Admin\HomeController@index')->name('admin');
//     Route::get('/user', 'Admin\UserController@index')->name('admin.user');    
// });
// Route::group(['middleware'=>['auth','checkRole:user,userplus']],function(){
//     Route::get('profile/{req}', 'User\UserController@detail')->name('user.detail');
//     });