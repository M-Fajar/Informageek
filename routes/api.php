
<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::post('register', 'Auth\RegisterController');
    Route::post('login', 'Auth\LoginController');
    Route::get('refresh', 'AuthConstroller@refresh');
    Route::get('posts/share/{id}', 'Post\PostController@sharePost');
    Route::get('posts/{post:id}', 'Post\PostController@show');
    Route::get('posts/comment/noauth/{post_id}','Post\CommentController@listComment');
    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('profile', 'User\ProfileController@me');
        Route::get('profile/{username}', 'User\ProfileController@index');
        Route::post('logout', 'Auth\LogoutController');

        Route::post('profile/update/avatar','User\ProfileController@updateAvatar'); 
        Route::post('profile/update/cover','User\ProfileController@updateCover'); 
        Route::post('profile/update','User\ProfileController@editProfile'); 

        Route::get('posts', 'Post\PostController@index');
        Route::get('posts/user/{user_id}', 'Post\PostController@postUser');

        Route::get('posts/last/{value}', 'Post\PostController@lastPostUser');
        
        Route::get('posts/create', 'Post\PostController@create');
        Route::post('posts/store', 'Post\PostController@store');
        Route::get('posts/{post:id}/edit', 'Post\PostController@edit');
        Route::patch('posts/{post:id}/edit', 'Post\PostController@update');
        Route::get('posts/{id}/delete', 'Post\PostController@destroy');
        Route::get('posts/trending/today', 'Post\PostController@trendingToday');

        

        Route::post('user/follow', 'User\FollowController@follow');
        Route::get('user/checkfollow/{username}', 'User\FollowController@checkFollow');
        Route::get('user/following','User\FollowController@ListFollowingMe');
        Route::get('user/following/{username}','User\FollowController@ListFollowing');
        Route::get('user/follower/{username}', 'User\FollowController@ListFollower');

        Route::get('user/all','User\UserController@getUsers');
        Route::get('hastag/all','CategoryController@getAll');
        Route::get('hastag/cek/{name}','CategoryController@cekFollow');
        Route::get('hastag/follow/{name}','CategoryController@follow');
        Route::get('hastag/posts/last/{name}','CategoryController@getPostsLast');
        Route::get('hastag/posts/popular/{name}','CategoryController@getPostsPopular');
        Route::get('hastag/trending','CategoryController@trending');
        Route::get('hastag/user/{username}','CategoryController@getHastagUser');

        Route::post('posts/comment','Post\CommentController@comment');
        Route::get('posts/comment/{post_id}','Post\CommentController@listComment');
        Route::post('posts/like','Post\LikeController@likePost');
        Route::get('posts/getlikes/{id}','Post\LikeController@getLikes');
        Route::post('posts/favorite','Post\LikeController@getFavorite');



        Route::group(['prefix' => 'chat'], function () {
            Route::get('/conversation/{id}','ContactsController@getMessagesFor');
            Route::post('/conversation/send','ContactsController@send');
            Route::get('/contact','ContactsController@get');
        });	

        Route::group(['prefix'=>'message', 'as' => 'message'], function () {
            Route::get('/', 'User\MessageController@index');
            Route::get('/chat/{room}', 'User\MessageController@fetchMessage')->name('.chat');
            Route::post('/send', 'User\MessageController@sendMessage')->name('.send-message');
            Route::get('/setread/{id}','User\MessageController@setread');
            Route::get('/room', 'User\MessageController@fetchroom')->name('.room');
            Route::get('/room/create', 'User\RoomController@create')->name('.room.create');
            Route::post('/room/store', 'User\RoomController@store')->name('.room.store');
            Route::get('/room/delete', 'User\MessageController@deleteRoom')->name('.room.delete');
            Route::get('/unread', 'User\MessageController@getUnreadCount');
        });
        

    });
});
