<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{
    public function index(){
        $data = [ 'posts' => Post::with('user','thumbnails')->orderBy('id','DESC')->get() ];
       
        return view('backend.admin.post.index',$data);

    }


    public function delete ($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return redirect('/admin/post')->with('status', 'Data telah di hapus');
    }

    public function show (Request $request, $id)
    {
        $post = Post::findOrFail($id);
        return view('backend.admin.post.show')->with('post', $post);
    }
}
