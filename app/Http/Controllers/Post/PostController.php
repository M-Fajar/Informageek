<?php

namespace App\Http\Controllers\post;

use App\Post;
use App\User;
use App\Category;
use App\Thumbnail;
use App\Comment;
use App\Like;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function getDataPost($posts,$auth_id){
        $foto= array();
        $username=array();
        $likes = array();
        $favorite = array();
        $thumbnail = array();
        $comment = array();
        foreach ($posts as $post) {
            $getfoto = DB::table('users')->where('id', $post['user_id'])->value('foto');
            $foto[$post['id']] = $getfoto;
            $getusername = DB::table('users')->where('id', $post['user_id'])->value('username');
            $username[$post['id']] = $getusername;
            $getlikes = Like::where('post_id',$post['id'])->count();
            $likes[$post['id']] =$getlikes;
            $getFavorite = Like::where('post_id',$post['id'])->where('user_Id',$auth_id)->exists();
            $favorite[$post['id']] =$getFavorite;
            $getThumbnail = Thumbnail::where('post_id',$post['id'])->pluck('name')->all();
            $thumbnail[$post['id']] = $getThumbnail;
            $getComment = Comment::where('post_id',$post['id'])->count();
            $comment[$post['id']] = $getComment;
        }
       
        return ([
            'posts' => $posts,
            'thumbnail' => $thumbnail,
            'likes' => $likes,
            'favorite' => $favorite,
            'comment' => $comment,
            'foto' => $foto,
            'username' => $username

           
         ]);

        
    }
    public function show($id)
    {   
        $id = base64_decode($id);
        $posts= Post::where('id',$id)->get();
        if(auth()->user()->id != null)
            return response()->json($this->getDataPost($posts,auth()->user()->id));
        else{
            return response()->json($this->getDataPost($posts,null));
        }
        
    }

    public function index(Request $request)
    {
        $auth_id = auth()->user()->id;
        $posts = Post::orderBy('id', 'DESC')->get();
        return response()->json($this->getDataPost($posts,$auth_id));
        
    }

    public function postUser($user){
        $auth_id = auth()->user()->id;
        $user_id = User::where('username',$user)->value('id');
        $posts = Post::where('user_id',$user_id)->orderBy('id', 'DESC')->get();
        
       
        return response()->json($this->getDataPost($posts,$auth_id));
        
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
                $catName = strtolower($catName);
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
                $tmb = $file->store('/posts');
                $post->thumbnails()->create(['name' => str_replace('posts/', '', $tmb)]);
            }
        }
        $post = Post::where('id',$post['id'])->get();
        return response()->json($this->getDataPost($post,auth()->user()->id));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    

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
            $catName = strtolower($catName);
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
    public function destroy($id)
    {     
        $post = Post::where('id',$id)->first();
       
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

    public function sharePost($id){
        $encrypted = base64_encode($id);
        $url = "https://informageek.tech/post/".$encrypted;
        return response()->json($url);
    }

    public function trendingToday(){
        $today = Carbon::today();
        $data = Post::where('created_at',">=",$today)->with('likes')->get();
        if(!count($data) > 0){
            $yesterday = Carbon::today()->subDays(1);
            $data = Post::where('created_at',">=",$yesterday)->with('likes')->get();
           
            if(!count($data) > 0){
                $yesterday = Carbon::today()->subDays(2);
                $data = Post::where('created_at',">=",$yesterday)->with('likes')->get();
           
                if(!count($data) > 0){
                    $yesterday = Carbon::today()->subDays(3);
                    $data = Post::where('created_at',">=",$yesterday)->with('likes')->get();
           
                }
            }

        }
        $data =  collect($data);
        $sorted = $data->sortByDesc('likes');
        $data = $sorted->values()->toArray();
        return response()->json($this->getDataPost(array_slice($data,0,1),auth()->user()->id));
        
    }

    

}
