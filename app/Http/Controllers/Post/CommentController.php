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
        $comment = Comment::with(['child'])->where('post_id', $post_id)->first();

        return response()->json([
            'comments' => $comment
        ]);
    }
}
