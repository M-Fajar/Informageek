<?php
namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class LogoutController extends Controller
{
    public function __invoke(Request $request){
        
        $id = $request->user()->id;
        
        DB::table('users')->where('id',$id)
        ->update(['token' => NULL]);
        
        auth()->logout();

        return response()->json([
            'status' => 'success',
            'msg' => 'Logged out Successfully.'
        ], 200);
    }
}
