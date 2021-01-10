<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Events\NewMessage;
use App\Message;
use App\Room;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class MessageController extends Controller
{
    public function fetchMessage($room_id)
    {   
        $id_user = auth()->user()->id;
        
        $message = Message::with(['user' => function($q) 
        {
            $q->select('id','name','foto');
        }])->where('room_id', $room_id)->get();
        $room = Room::find($room_id);
        if (isset($room->name)) {
            $user = $room->user()->select('name')->get();
            $room_name = $room->name;
           
        } else {
            $user = $room->user()->select('users.id','users.name','users.username','users.foto')->where('users.id', '!=', $id_user)->get();
        
            $room_name = $user[0]->name;
        } 
        // $this->deleteRoom();
        Message::where('user_id','!='   ,$id_user)->where('room_id',$room_id)->update(['read' => 1]);
        return response()->json([
            'user' => $user, 'room_name' => $room_name, 'room_id' => $room_id,'chat' => $message
        ]);
        
    }

    public function fetchRoom(Request $request)
    {
        $id_user = $request->user()->id;
       
        $room_list = auth()->user()->room()->with(['message' => function ($m)
        {
            $m->orderBy('id','desc')->get();
        }, 'user' => function ($u) use ($id_user)
        {
            $u->select('users.id', 'users.name','users.username','users.foto')->where('users.id', '!=', $id_user);
        }])->orderBy('id','desc')->get();
        
       
        return  response()->json(
            
            $room_list
        );
    }

    public function sendMessage(Request $request)
    {   
        $message =Message::create([
            'message' => $request->message,
            'room_id' => $request->room,
            'user_id' => $request->user()->id
        ]);
        
        $message = Message::with(['user' => function($q) 
        {
            $q->select('id','name','foto');
        }])->where('id', $message['id'])->first();

        broadcast(new NewMessage($message));
        return response()->json($message);
    }

    public function setread($id){
        $message =  Message::where('id',$id)->update(["read" => 1]);
        
    }

    public function deleteRoom(){
        $data = auth()->user()->room()->where('group',false)->doesntHave('message')->get();
        foreach ($data as $key => $value) {
            $lastMinute = Carbon::now()->subMinutes(1);
            $room = Room::where('id',$value['id'])->where('created_at','<',$lastMinute)->first()->delete();
        }
        
    }

    public function getUnreadCount()
    {
        $data = auth()->user()->room()->with('message')->get();
        $count = 0;
        foreach ($data as $item) {
            foreach ($item['message'] as $value) {
                if($value['read'] == false && $value['user_id'] != auth()->user()->id){
                    $count++;
                }
            }
        }
        
        return response()->json($count); 
    }
}
