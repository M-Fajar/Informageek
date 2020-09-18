<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Room;
use App\User;

class RoomController extends Controller
{
    public function create()
    {
    	$id_user = Auth::id();
    	$user = User::select('id', 'name')->where('id', '!=', $id_user)->orderBy('name', 'asc')->get();
    	return view('backend.message.create_room', ['user' => $user]);
    }

    public function store(Request $request)
    {
    	$id_user = Auth::id();
    	$request->validate([
    		'user' => 'required'
    	]);
        if (!$this->hasRoom($request->user)) {
            $room = Room::create([
                'name' => null
            ]);

            $room->user()->sync([$id_user, $request->user]);
        }
    	
    	return redirect()->route('message');
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
}
