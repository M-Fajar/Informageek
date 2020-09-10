<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Events\MessageSent;
use App\Message;
use App\Room;

class MessageController extends Controller
{
    //
    public function index()
    {
    	return view('backend.message.index');
    }

    public function fetchMessage($room)
    {
        $id_user = Auth::id();
        $message = Message::with(['user' => function($q) 
        {
            $q->select('id','name');
        }])->where('room_id', $room)->get();
        $room = Room::find($room);
        if (isset($room->name)) {
            $user = $room->user()->select('name')->get();
        } else {
            $user = $room->user()->select('name')->where('users.id', '!=', $id_user)->get();
        }
        return ['user' => $user, 'chat' => $message];
    }

    public function fetchRoom()
    {
        $id_user = Auth::id();
        $room_list = Room::with(['message' => function ($m)
        {
            $m->orderBy('id', 'desc')->first();
        }, 'user' => function ($u) use ($id_user)
        {
            $u->select('users.id', 'users.name')->where('users.id', '!=', $id_user);
        }])->get();
        return $room_list;
    }

    public function sendMessage(Request $request)
    {
        $message = auth()->user()->message()->create([
            'message' => $request->message,
            'room_id' => $request->room
        ]);

        broadcast(new MessageSent($message->load('user')))->toOthers();

        return ['status' => 'Success!!'];
    }
}
