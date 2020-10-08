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

// Route::get('/home', 'HomeController@index')->name('home');
Auth::routes();
Route::get('/', function () {
	return redirect()->route('home');
});


Route::get('/home', 'Post\PostController@index')->name('home');

// ADMIN
Route::group(['middleware' => ['auth', 'checkRole:admin'], 'prefix' => 'admin'], function () {

	Route::get('/', 'Admin\HomeController@index')->name('admin');
	Route::get('/user', 'Admin\UserController@index')->name('admin.user');
	Route::get('/category', 'Admin\CategoryController@index')->name('admin.category');
});
// Kategori Admin
Route::group(['middleware' => ['auth', 'checkRole:admin'], 'prefix' => 'admin/category'], function () {
	// Route::get('create', 'Admin\CategoryController@create')->name('category.create'); // create nyatu dihalaman index pake modal
	Route::post('store', 'Admin\CategoryController@store')->name('category.store');
	Route::get('{category:slug}/edit', 'Admin\CategoryController@edit')->name('category.edit');
	Route::patch('{category:slug}/edit', 'Admin\CategoryController@update')->name('category.update');
	Route::delete('{category:slug}/delete', 'Admin\CategoryController@destroy')->name('category.delete');
});


// PROFILE
Route::group(['middleware' => ['auth', 'checkRole:user,userplus']], function () {
	Route::get('profile/{req}', 'User\UserController@detail')->name('user.detail');
});


// POST
Route::middleware('auth')->group(function () {
	// ALL POST
	Route::get('posts', 'Post\PostController@index')->name('posts.index')->withoutMiddleware('auth');
	// CREATE
	Route::get('posts/create', 'Post\PostController@create')->name('posts.create'); // route ini harus ada di atas route yang posts/{post:slug}. karena kalau dia ada dibawah, nanti laravel ngiranya 'create' itu adalah slug, makanya nanti url ini akan not found kalau di ketik nya dibawah posts/create
	Route::post('posts/store', 'Post\PostController@store');
	// UPDATE
	Route::get('posts/{post:id}/edit', 'Post\PostController@edit');
	Route::patch('posts/{post:id}/edit', 'Post\PostController@update');
	// DELETE
	Route::delete('posts/{post:id}/delete', 'Post\PostController@destroy');
	// READ
	Route::get('posts/{post:id}', 'Post\PostController@show')->name('posts.show')->withoutMiddleware('auth');
});
