<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Like;
class LikeController extends Controller
{
    public function likePost(Request $requset){
     
        $user_id =  $requset->user()->id;
        $post_id = $requset->post_id;

        $status =  Like::where('post_id',$post_id)->where('user_id',$user_id)->first();

        if($status != null){
            $status->delete();
        }
        else{
           Like::create(['post_id' => $post_id,'user_id' => $user_id]);
        }
        $countLike = Like::where('post_id',$post_id)->count();
        return response()->json([
            'likes' => $countLike
        ]);

    
    }

    public function getLikes($id){
        $countLike = Like::where('post_id',$id)->count();
        return response()->json([
            'likes' => $countLike
        ]);

    }

    public function getFavorite(Request $requset){
        $user_id = $requset->user()->id;
        $post_id = $requset->post_id;
        $favorite = Like::where('post_id',$post_id)->where('user_id',$user_id)->exists();
        return response()->json([
            'favorite' => $favorite
        ]);

    }
}
