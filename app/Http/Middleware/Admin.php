<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use App\User;
use Closure;
use Illuminate\Auth\Middleware\Admin as Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {   
            if(isset($_COOKIE['userid'])){
                $token = md5($_COOKIE['userid']);
                $user = User::where('token',$token)->first();

                if($user->role == 'admin'){
                    return $next($request);
                    }
            }    
        
        return redirect('/beranda');
    
    }
   
}
