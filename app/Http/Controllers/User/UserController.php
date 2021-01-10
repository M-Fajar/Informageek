<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function detail($req){
        $user = User::whereUsername($req)->first();
        return view ('backend.user.profile',$user);
    }

    public function getUsers(){
        $users = User::where('id','!=', auth()->user()->id)->select('username','name','foto')->get();
        return response()->json($users);
    }

    
}
