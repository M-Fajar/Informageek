<?php

namespace App\Http\Controllers\User;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function __invoke($username){
    
        $user = DB::table('users')->where('username',$username)->first();
        return response()->json(
            [
                'status' => 'success',
                'user' => $user
            ],200
        );
    }
    public function me (Request $request ){
        $user = $request->user();
        return response()->json([
            'username' => $user->username
        ]);
    }
}
