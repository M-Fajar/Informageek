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
      $user2_id = $request->user2;
      if($user_id ==$user2_id) {
        return response()->json([
          'error' => 'Gagal Follow'
        ], 401);
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
    public function getCountFollowing($user2_id){
       return  Followers::where('follower_id', $user2_id)->count();
    }
    public function ListFollowing (Request $request) {
      $user2_id = $request->user;
      $listfollowing = Followers::where('follower_id', $user2_id)->select('following_id')->get();
      $userlist = array();
      foreach ($listfollowing as $value) {
          $user = User::find($value['following_id']);
          array_push($userlist,$user);
      }

      return response()->json([
        'Total' => $this->getCountFollowing($user2_id),
        'Following' =>$userlist
      ]);
    }
    public function ListFollower(Request $request){
      $user2_id = $request->user;
      $listfollower = Followers::where('following_id', $user2_id)->select('follower_id')->get();
      $userlist = array();
      foreach ($listfollower as $value) {
        $user = User::find($value['follower_id']);
        array_push($userlist,$user);
      }
      return response()->json ([
        'Total' => $this-> getCountFollower($user2_id),
        'Follower' =>$userlist
      ]);


    }

}
