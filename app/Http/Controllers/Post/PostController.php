<?php

namespace App\Http\Controllers\post;

use App\Post;
use App\User;
use App\Category;
use App\Thumbnail;
use App\Comment;
use App\Like;
use Illuminate\Support\Str;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user_id = $request->user()->id;
        $posts = Post::orderBy('id', 'DESC')->get();
        $foto= array();
        $username=array();
        $likes = array();
        $favorite = array();
        
        foreach ($posts as $post) {

            $getfoto = DB::table('users')->where('id', $post['user_id'])->value('foto');
            array_push($foto,$getfoto);
            $getusername = DB::table('users')->where('id', $post['user_id'])->value('username');
            array_push($username,$getusername);
            $getlikes = Like::where('post_id',$post['id'])->count();
            array_push($likes,$getlikes);
            $getFavorite = Like::where('post_id',$post['id'])->where('user_Id',$user_id)->exists();
            array_push($favorite,$getFavorite);
        }
       
        return response()->json([
            'posts' => $posts,
            'foto' => $foto,
            'likes' => $likes,
            'favorite' => $favorite,
            'username' => $username

           
         ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $post = new Post();
        $categories = Category::get();
        return response()->json([
            'post' => $post,
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $user = Auth::user();
        $post = new Post();
        $data = $request->all();
        $post = $user->posts()->create($data);

        $catIds = [];
        if($request->categories != null){
            foreach ( $request->categories as $catName){
            $cat = Category::where('name', $catName)->first();
                if (!$cat) {
            
                $categories = new Category;
                $categories->name = $catName;
                $categories->slug = Str::slug($catName);
                $categories->save();
                $cat = Category::where('name', $catName)->first();
                }
            array_push($catIds,$cat->id);
            }   
        $post->categories()->sync($catIds);
        }

        $request->validate([
            'thumbnail' => 'image|mimes:jpg,jpeg,png,svg|max:3096',
            'thumbnail.*' => 'image|mimes:jpg,jpeg,png,svg|max:3096',
        ]);
    
       if ($request->photo_id) {
            $files = $request->photo_id;
            foreach ($files as $file) {
                $name = time() . '-' . $file->getClientOriginalName();
                $name = str_replace(' ', '-', $name);
                $tmb = $file->store('images/posts');
                $post->thumbnails()->create(['name' => str_replace('images/posts/', '', $tmb)]);
            }
        }
        return response()->json([
            'status' => 'success',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $username = DB::table('users')->where('id', $post->user_id)->value('username');
        $foto = DB::table('users')->where('id', $post->user_id)->value('foto');
        return response()->json([
            'post' => $post,
            'username' => $username,
            'foto' => $foto,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::get();
        return response()->json([
            'post' => $post,
            'categories' => $categories
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post)
    {
        $request->validate([
            'thumbnail' => 'image|mimes:jpg,jpeg,png,svg|max:3096',
            'thumbnail.*' => 'image|mimes:jpg,jpeg,png,svg|max:3096',
        ]);
        $this->authorize('update', $post);
        // update dan hapus image lama
        if ($request->hasFile('photo_id')) {
            $thumb = Thumbnail::where('post_id', $post->id)->get();
            foreach ($thumb as $thu) {
                Storage::delete('images/posts/' . $thu->name);
            }
            $post->thumbnails()->delete();
            $files = $request->file('photo_id');
            foreach ($files as $file) {
                $tmb = $file->store('images/posts');
                $post->thumbnails()->create(['name' => str_replace('images/posts/', '', $tmb)]);
            }
        }
        // update post keseluruhan 
        $attr = $request->all();
        $post->update($attr);

        // update kategori
        $catIds = [];
        foreach ($request->categories as $catName) {
            $cat = Category::where('name', $catName)->first();
            if (!$cat) {
                $categories = new Category;
                $categories->name = $catName;
                $categories->slug = Str::slug($catName);
                $categories->save();
                $cat = Category::where('name', $catName)->first();
            }
            array_push($catIds, $cat->id);
        }
        $post->categories()->sync($catIds);
        // $post->categories()->sync(request('categories'));

        return response()->json([
            'status' => 'success'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        $thumb = Thumbnail::where('post_id', $post->id)->get();
        foreach ($thumb as $thu) {
            Storage::delete('images/posts/' . $thu->name);
        }
        $post->thumbnails()->delete();
        $post->categories()->detach();
        $post->delete();
        return response()->json([
            'status' => 'success'
        ]);

    }



    public function lastPostUser(Request $request, $value){
        
        $user_id = $request->user()->id;
        $lastpost = Post::where(['user_id'=>$user_id ])->orderBy('id', 'DESC')->take($value)->get();
        $username = DB::table('users')->where('id', $user_id)->value('username');
        $foto = DB::table('users')->where('id', $user_id)->value('foto');
        return response()->json([
            'posts' => $lastpost,
            'username'=> $username,
            'foto' => $foto
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
        return response()->json([
            'status' => 'succes'
        ]);
    }
    

}
