<?php

namespace App\Http\Controllers\post;

use App\Post;
use App\Category;
use App\Thumbnail;
use Illuminate\Http\Request;

use App\Http\Requests\PostRequest;
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
        $posts = Post::latest()->paginate(5);
        $categories = Category::get();
        // return view('backend.post.index', [
        //     'posts' => $posts,
        //     'categories' => Category::get()
        // ]);
        return response()->json([
            'posts' => $posts,
            'categories' => $categories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return view('backend.post.create', [
        //     'post' => new Post(),
        //     'categories' => Category::get()
        // ]);
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

        // return redirect('home');
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
        // return view('backend.post.show', compact('post'));
        return response()->json([
            'post' => $post
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
        // return view('backend.post.edit', [
        //     'post' => $post,
        //     'categories' => Category::get()
        // ]);
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
        // validasi
        $request->validate([
            'thumbnail' => 'image|mimes:jpg,jpeg,png,svg|max:3096',
            'thumbnail.*' => 'image|mimes:jpg,jpeg,png,svg|max:3096',
        ]);

        // auth
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

        // session()->flash('success', 'Postingan telah diedit');
        // return redirect('home');
        return response()->json([
            'status' => 'success'
        ]);
        // kurang
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

        // delete thumbnail
        $thumb = Thumbnail::where('post_id', $post->id)->get();
        foreach ($thumb as $thu) {
            \Storage::delete('images/posts/' . $thu->name);
        }
        $post->thumbnails()->delete();

        // delete category
        $post->categories()->detach();

        // delete post
        $post->delete();

        // notif dan redirect
        // session()->flash('success', 'Postingan telah dihapus');
        // return redirect('home');
        return response()->json([
            'status' => 'success'
        ]);
    }
}
