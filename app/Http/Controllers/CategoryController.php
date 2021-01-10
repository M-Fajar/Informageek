<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use App\User;
use App\Thumbnail;
use App\Comment;
use App\Like;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function trending()
    {   
        $date = Carbon::today()->subDays(7);
        
        $data= Category::with(['posts' => function ($query) use ($date){
            
                $query->where('updated_at',">=",$date)->get();
            
        }])->get();
        $data =  collect($data);
        $sorted = $data->sortByDesc('posts');
        $data = $sorted->values()->toArray();
        return response()->json($data);
        
        
    }

    public function create()
    {
        //
    }

    public function getAll()
    {
        $data = Category::with('posts')->select('id','name')->get();
        return response()->json($data);
    }

    public function follow($name){
        $user_id = auth()->user()->id;
        $cat = Category::where('name',$name)->first();

        $status = "unfollow";
        if(!$cat->user()->detach($user_id)){
            $cat->user()->attach($user_id);
            $status = "follow";
        }

        return response()->json($status);
        }

    public function cekFollow($name){
            $id = Category::where('name',$name)->value('id');
          $status = DB::table('category_user')
          ->where('user_id',auth()->user()->id)
          ->where('category_id',$id)->exists();
          
          return response()->json($status);
    }

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

    public function getPostsLast($name){
        $data = Category::where('name',$name)->with('posts')->first();
        $data = $data['posts'];
        $data =  collect($data);
        $sorted = $data->sortByDesc('id');
        $data = $sorted->values()->toArray();
       
        return response()->json([$this->getDataPost($data,auth()->user()->id)]);
    }
    
    public function getPostsPopular($name){
        $data = Category::where('name',$name)->with('posts.likes')->first();
        $data = $data['posts'];
        $data =  collect($data);
        $sorted = $data->sortByDesc('likes');
        $data = $sorted->values()->toArray();
       
        return response()->json([$this->getDataPost($data,auth()->user()->id)]);
    }

    public function getHastagUser($username){
        $data = User::where('username',$username)->with('categories')->first();
        return response()->json($data['categories']);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate(['name' => 'required|max:30']);
        $data['slug'] = Str::slug($request->name);
        Category::create($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Category $category)
    {
        $data = request()->validate([
            'name' => 'required|max:30'
        ]);
        $category->update($data);
        return response()->json([
            'status' => 'success',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return response()->json([
            'status' => 'success',
        ]);
    }


}
