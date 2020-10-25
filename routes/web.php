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


//Route Backend

// ADMIN
Route::group(['middleware' => ['admin'],'prefix' => 'admin'],function(){

	Route::get('/', 'Admin\HomeController@index')->name('admin');
	Route::get('/dashboard', 'Admin\HomeController@index')->name('home');;
	Route::post('logout', 'Admin\AuthController@logout')->name('logout');
	Route::get('reqpass', 'AuthController@logout')->name('password.request');
	Route::get('register', 'AuthController@showFormRegister')->name('register');
	

	//ADMIN CATEGORY
	Route::group(['prefix' => 'category'], function () {
		Route::get('/', 'Admin\CategoryController@index')->name('admin.category');
		Route::post('store', 'Admin\CategoryController@store')->name('category.store');
		Route::get('{category:slug}/edit', 'Admin\CategoryController@edit')->name('category.edit');
		Route::patch('{category:slug}/edit', 'Admin\CategoryController@update')->name('category.update');
		Route::delete('{category:slug}/delete', 'Admin\CategoryController@destroy')->name('category.delete');
	});	

	Route::group(['prefix' => 'user'], function () {
		Route::get('/', 'Admin\UserController@index')->name('admin.user');
		Route::get('/userupdate/{id}', 'Admin\UserController@userupdate');
    	Route::put('/user-register-update/{id}', 'Admin\UserController@userregisterupdate'); 
    	Route::delete('/userdelete/{id}', 'Admin\UserController@userdelete');  
		
	});	
});

//Route Frontend

Route::get('/{any}', function () {
     return view('welcome');
 })->where('any', '.*');
