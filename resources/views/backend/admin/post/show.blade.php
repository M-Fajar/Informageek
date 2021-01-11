@extends('backend.layouts.admin')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Edit Role Page for Registered User</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <form action="" method="POST">
                                
                                <div class="form-group">
                                    <label class="col-form-label">ID Post</label>
                                    <input type="text" readonly class="form-control-plaintext" value="{{ $post->id }}">
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">Username</label>
                                    <input type="text" readonly class="form-control-plaintext" value="{{ $post->user->username }}">
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">Postingan</label>
                                    <div class="card">
                                        
                                        <p>{{$post->body}}</p>
                                        
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group">
                                     @foreach ( $post->thumbnails as $item)
                                    <img style="width:200px;" src="/media/posts/{{$item->name}}" alt="">
                                    @endforeach
                                </div>
                                <a href="/admin/post" class="btn btn-primary">Kembali</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection