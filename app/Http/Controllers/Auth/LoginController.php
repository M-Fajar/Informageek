<?php
namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;


class LoginController extends Controller
{
    public function __invoke (Request $request){
        $credentials = $request->only('username', 'password');
        $token = auth()->attempt($credentials);
        if ($token){
            $user = auth()->user();
            if($user->role == 'admin'){
                DB::table('users')->where('username',$user->username)
                                  ->update(['token' => md5($token)]);
                
            }
            return response()->json(['status' => 'success','token' => $token ], 200)->header('Authorization', $token);
        }
        return response()->json(['error' => 'login_error'], 401);
    }
}
