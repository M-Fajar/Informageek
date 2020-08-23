<?php

namespace App\Http\Controllers\post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;

use App\Post;
use App\Category;
use App\Thumbnail;

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
        return view('backend.post.index', [
            'posts' => $posts,
            'categories' => Category::get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.post.create', [
            'post' => new Post(),
            'categories' => Category::get(),
            'thumbnails' => new Thumbnail()
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
        // // validasi
        // $request->validate([
        //     'thumbnail' => 'image|mimes:jpg,jpeg,png,svg|max:2048',
        //     'thumbnail.*' => 'image|mimes:jpg,jpeg,png,svg|max:5000' 
        // ]);
        // $attr = $request->all();
        // // slug
        // $slug = \Str::slug(request('title'));
        // $attr['slug'] = $slug;

        // // gambar
        // if ($request->hasFile('thumbnail')) {

        //    //  $thumbnails = request()->file();
        //    //  foreach($thumbnails as $thumbnail) {
        //    //      $thumbnail->store('images/posts');
        //    //      $attr['thumbnail'] = $thumbnail;
        //    // }

        //     foreach ($request->file('thumbnail') as $tmb) {
        //         $name = time() . '_' . rand(1, 999) . '.' . $file->extension();
        //         $file->move(public_path(). '/files/', $name);
        //         $gambar[] = $name; 
        //     }
        //     $post->thumbnails()->attach(request('thumbnails'));

        // }

        // // store
        // $post = auth()->user()->posts()->create($attr);
        // $post->categories()->attach(request('categories'));

        // session()->flash('success', 'Postingan telah dibuat');

        // return redirect('home');

        dd($request->file);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('backend.post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('backend.post.edit', [
            'post' => $post,
            'categories' => Category::get()
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
            'thumbnail' => 'image|mimes:jpg,jpeg,png,svg|max:3096'
        ]);
        $this->authorize('update', $post);
        if (request()->file('thumbnail')) {
            \Storage::delete($post->thumbnail);
            $thumbnail = request()->file('thumbnail')->store("image/posts");
        } else {
            $thumbnail = $post->thumbnail;
        }

        $attr = $request->all();

        $attr['thumbnail'] = $thumbnail;
        $post->update($attr);

        $post->categories()->sync(request('categories'));

        session()->flash('success', 'Postingan telah diedit');
        return redirect('home');
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
        \Storage::delete($post->thumbnail);
        $post->categories()->detach();
        $post->delete();
        session()->flash('success', 'Postingan telah dihapus');
        return redirect('home');
    }
}
