<?php
namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function __invoke (Request $request){
        $credentials = $request->only('username', 'password');
        if ($token = auth()->attempt($credentials)) {
            return response()->json(['status' => 'success','token' => $token], 200)->header('Authorization', $token);
        }
        return response()->json(['error' => 'login_error'], 401);
    }
}
