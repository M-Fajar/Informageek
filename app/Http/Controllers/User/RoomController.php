<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Room;
use App\User;

class RoomController extends Controller
{
    public function create(Request $request)
    {   
    
    	$user_id = $request->user()->id;
    	$user = User::select('id', 'name','username')->where('id', '!=', $user_id)->orderBy('name', 'asc')->get();
    	return response()->json(
            
            $user
        );
    }

    public function store(Request $request)
    {   
        $id_user = $request->user()->id;
        $request->validate([
    		'user' => 'required'
        ]);
        
        if($request->roomName != null){
            $users = $request->user;
            array_push($users,$id_user);
            $room = Room::create([
                'name' => $request->roomName ,
                'group' => true
            ]);
            $room->user()->sync($users);
        }
        
    	else{
            if (!$this->hasRoom($request->user[0])) {
                $room = Room::create([
                    'name' => null
                ]);
    
                $room->user()->sync([$id_user, $request->user[0]]);
            }
        }
        
    	
    	return redirect()->route('message.room');
    }

    private function hasRoom($id)
    {
        $room = auth()->user()->room()
                ->select('rooms.id')
                ->where(['group' => false])
                ->get();
        $has_room = false;
        foreach ($room as $key) {
            $idroom = $key['id'];
            $user = Room::find($idroom)->user()->where('users.id', '!=', Auth::id())->first();
            if ($user->id == $id) {
                $has_room = true;
                break;
            }
        }
        if ($has_room) {
            return true;
        } else {
            return false;
        }

    }
    public function deleteRoom($id){
        $room = auth()->user()->room()
                ->where(['id' => $id,'group'])
                ->first();
                dd($room);
    }
}
