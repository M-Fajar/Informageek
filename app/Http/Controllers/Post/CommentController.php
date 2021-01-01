<?php

namespace App\Http\Controllers\Post;

use App\Post;
use App\User;
use App\Category;
use App\Thumbnail;
use App\Comment;
use App\Like;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
class CommentController extends Controller
{
    public function listComment($post_id){
        $comment = Comment::with(['user','child','child.user'])->where('post_id', $post_id)->where('parent_id',NULL)->get();

        return response()->json([
            'comments' => $comment
        ]);
    }
    public function comment(Request $request){
        //VALIDASI DATA YANG DITERIMA
        $this->validate($request, [
            'post_id' => 'required',
            'comment' => 'required',
        ]);
            
        $user_id = $request->user()->id;
        Comment::create([
            'post_id' => $request->post_id,

            'parent_id' => $request->parent_id != '' ? $request->parent_id:NULL,
            'user_id' => $user_id,
            'comment' => $request->comment
        ]);

        $count = comment::where('post_id',$request->post_id)->count();
        $comment = Comment::with(['user','child','child.user'])->where('post_id', $request->post_id)->where('parent_id',NULL)->get();
        return response()->json([
            'status' => 'succes',
            'count' => $count,
            'comment' => $comment

        ]);
}

}
