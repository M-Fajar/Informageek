@extends('backend.layouts.app')

@section('content')
<section class="p-0 m-0">
    <div class="container">
        <div class="d-flex justify-content-between">
            <div>
                Posts
            </div>
            <div class="">
                @if(Auth::check())
                <a href="{{ route('posts.create') }}" class="btn btn-primary">New Post</a>
                @else
                <a href="{{ route('posts.create') }}" class="btn btn-primary">Login to create a post</a>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                cek
            </div>
            <div class="col-md-7">
                @foreach($posts as $post)
                @if($post->thumbnails->count()>0)
                @for($i=0; $i<count($images=$post->thumbnails()->get()); $i++)

                    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            @if($i==0)
                            <div class="carousel-item active">
                                <img src="/storage/images/posts/{{ $images[$i]['name'] }}" class="d-block w-100" alt="...">
                            </div>
                            @else
                            <div class="carousel-item">
                                <img src="/storage/images/posts/{{ $images[$i]['name'] }}" class="d-block w-100" alt="...">
                            </div>
                            @endif
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                    @endfor
                    @endif
                    <div class="card">
                        <div class="card-header">
                            @if($post->thumbnail)
                            <a href="{{ route('posts.show', $post->id) }}">
                                <img style="height: 380px" src="{{ $post->takeImage }}">
                            </a>
                            @endif
                            <h3><a href="{{ route('posts.show', $post->id) }}">
                                    {{ $post->title }}</a></h3>
                            <p>By: {{ $post->user->name }}</p>
                            <p>Kategori:
                                @foreach($post->categories as $category)
                                <small>{{ $category->name }}</small>
                                @endforeach
                            </p>
                        </div>
                        <div class="card-body">
                            {{ Str::limit($post->body, 300) }}
                        </div>
                        <div class="card-footer">
                            <small class="text-secondary">{{ $post->created_at->diffForHumans() }}</small>
                        </div>
                    </div>
                    @endforeach
                    <div>{{ $posts->links() }}</div>
            </div>
            <div class="col-md-2">
                cek
            </div>
        </div>
    </div>
</section>
@endsection