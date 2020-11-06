<?php

namespace App\Http\Controllers\post;

use App\Post;
use App\User;
use App\Category;
use App\Thumbnail;
use Illuminate\Support\Str;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::get();

        $posts = Post::orderBy('id', 'DESC')->get();
        foreach ($posts as $post) {
            $foto = DB::table('users')->where('id', $post['user_id'])->value('foto');
            $username = DB::table('users')->where('id', $post['user_id'])->value('username');
            return response()->json([
                'posts' => $posts,
                'foto' => $foto,
                'username' => $username,
                'categories' => $categories,
            ]);
        }
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

        // coba category
        $categories = new Category;
        $categories->name = $request->categories;
        $categories->slug = Str::slug($request->categories);
        $categories->save();
        $post->categories()->attach($post);
        // $categories->posts()->attach($categories);
        // batas coba category

        $request->validate([
            'thumbnail' => 'image|mimes:jpg,jpeg,png,svg|max:3096',
            'thumbnail.*' => 'image|mimes:jpg,jpeg,png,svg|max:3096',
        ]);
        if ($request->hasFile('photo_id')) {
            $files = $request->file('photo_id');
            foreach ($files as $file) {
                $name = time() . '-' . $file->getClientOriginalName();
                $name = str_replace(' ', '-', $name);
                $tmb = $file->store('images/posts');
                $post->thumbnails()->create(['name' => str_replace('images/posts/', '', $tmb)]);
            }
        }
        return response()->json([
            'status' => 'success'
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
        $username = DB::table('users')->where('id', $post['user_id'])->value('username');
        $foto = DB::table('users')->where('id', $post['user_id'])->value('foto');
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
                \Storage::delete('images/posts/' . $thu->name);
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
        $post->categories()->sync(request('categories'));
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
            \Storage::delete('images/posts/' . $thu->name);
        }
        $post->thumbnails()->delete();
        $post->categories()->detach();
        $post->delete();
        return response()->json([
            'status' => 'success'
        ]);
    }
}
