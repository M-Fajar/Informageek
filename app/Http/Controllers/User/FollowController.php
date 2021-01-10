<?php

namespace App\Http\Controllers\User;
use App\User;
use App\Followers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    public function follow (Request $request){

      $user_id = $request->user()->id;
      $username = $request->user;
      $user2_id = User::where('username',$username)->value('id');
      
    
      if($user_id ==$user2_id) {
        return response()->json([
          'error' => 'Gagal Follow'
        ], 400);
      }
      $following = Followers::where('following_id', $user2_id)->where('follower_id',$user_id)->first();
      $status;
      if($following != null){
        $following->delete();
        $status = "Unfollow";
      }
      else{
        $following = Followers::firstOrCreate(['following_id' => $user2_id,'follower_id' => $user_id]);
        $status = "Follow";
      }
      $user = DB::table('users')->where('id',$following['following_id'])->value('username');
      return response()->json([
        'status' => 'success',
        'kondisi' => $status,
        'user' => $user
      ]);
    }

    public function getCountFollower($user2_id){
       return  Followers::where('following_id', $user2_id)->count();
    }
    public function getCountFollowing($user){
       return  Followers::where('follower_id', $user)->count();
    }
    public function ListFollowing ($username) {
     
        $user = User::where('username',$username)->value('id');//get Id
     
        
      $listfollowing = Followers::where('follower_id', $user)->select('following_id')->get();
      $userlist = array();
      foreach ($listfollowing as $value) {
          $user = User::where('id',$value['following_id'])->select('name','username','foto')->first();
          array_push($userlist,$user);
      }

      return response()->json([
        'total' => count($userlist),
        'following' =>$userlist
      ]);
    }
    public function ListFollowingMe () {   
    $user = auth()->user()->id;
   
    $listfollowing = Followers::where('follower_id', $user)->select('following_id')->get();
    $userlist = array();
    foreach ($listfollowing as $value) {
        $user = User::where('id',$value['following_id'])->select('name','username','foto','id')->first();
        array_push($userlist,$user);
    }

    return response()->json([
      'total' => count($userlist),
      'following' =>$userlist
    ]);
  }
    public function ListFollower($username){
      $user = User::where('username',$username)->value('id'); //get Id
      $listfollower = Followers::where('following_id', $user)->select('follower_id')->get();
      $userlist = array();
      foreach ($listfollower as $value) {
        $user = User::where('id',$value['follower_id'])->select('name','username','foto')->first();
        array_push($userlist,$user);
      }
      return response()->json ([
        'total' => count($userlist),
        'follower' =>$userlist
      ]);


    }
    public function checkFollow($username){
      $user1_id = auth()->user()->id;
      
      $user2_id = User::where('username',$username)->value('id');
      
      $status =  Followers::where('follower_id', $user1_id)->where('following_id',$user2_id)->exists();
      return response()->json([
        'status' => $status,
        'id' => $user2_id
      ]);
    }

}
