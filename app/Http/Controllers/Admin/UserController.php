<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use DB;
use Spatie\Permission\Moddel\Role;

class UserController extends Controller
{
    public function index(){

        $data = [ 'users' => User::orderBy('id','DESC')->get()
                
        ];
        return view('backend.admin.user.index',$data);
    }
    public function userupdate (Request $request, $id)
    {
        $users = User::findOrFail($id);
        return view('backend.admin.user.update')->with('users', $users);
    }

    public function userregisterupdate (Request $request, $id)
    {
        $users = User::find($id)->update(['role' => $request->input('roles-user')]);
        

        return redirect('/admin/user')->with('status', 'Data telah di update');
    }

    public function userdelete ($id)
    {
        $users = User::findOrFail($id);
        $users->delete();

        return redirect('/admin/user')->with('status', 'Data telah di hapus');
    }
}
