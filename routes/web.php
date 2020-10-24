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


//Route Backend





Route::group(['prefix'=>'admin'],function(){
    
    Route::get('login', 'Admin\AuthController@showFormLogin')->name('login');
    Route::post('login', 'AuthController@login');
    Route::group(['middleware' => 'admin'], function () {
        
    Route::get('/', 'Admin\HomeController@index')->name('admin');    
        Route::get('/user', 'Admin\UserController@index')->name('admin.user');    
        Route::get('/dashboard', 'Admin\HomeController@index')->name('home');
        Route::post('logout', 'Admin\AuthController@logout')->name('logout');
        Route::get('reqpass', 'AuthController@logout')->name('password.request');
        Route::get('register', 'AuthController@showFormRegister')->name('register');

     
    });

 });


Route::get('/{any}', function () {
     return view('welcome');
 })->where('any', '.*');
