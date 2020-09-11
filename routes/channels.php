<?php

use Illuminate\Support\Facades\Broadcast;
use App\Room;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});
Broadcast::channel('room.{id}', function ($user, $id) {
	$room = Room::find($id);
	$message_user = $room->user()->where(['users.id' => $user->id])->first();
    if ($message_user->id == $user->id) {
    	return $user;
    }
});