@extends('backend.layouts.admin')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>User Management</h4> <br>
                @if (session('status'))
                    <div class="alert alert-success" role= "alert">
                        {{session('status') }}
                    </div>
                @endif
                <div class="card-header-action">
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table align-items-center table-hover" id="table">
                        <thead class="thead-light">
                            <tr>
                                <th>No</th>
                                <th>ID</th>
                                <th>User</th>
                                <th>Postingan</th>
                                <th>Thumbnail</th>
                                <th width="10%">Aksi</th>
                                <th width="10%">Hapus</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $no = 0;?>
                           @foreach ( $posts as $item)
                        <?php $no++ ;?> 
                            <tr>
                                <td>{{$no}}</td>
                                <td>{{$item->id}} </td>
                                <td>{{$item->user->username}}</td>
                                <td>{{ substr($item->body,0,15)}}</td>
                                <td>@foreach ( $item->thumbnails as $item)
                                    <img style="width:50px;height:30px;" src="/media/posts/{{$item->name}}" alt="">
                                    @endforeach
                                </td>
                                <td>
                                    <a href="post/show/{{ $item->id }}" class="btn btn-primary">Lihat</a>
                                </td>
                                <td>
                                    <form action="post/delete/{{ $item->id }}" method = "post" onsubmit= "return confirm('Yakin menghapus data tersebut ?')">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button href="#" class="btn btn-danger">DELETE</button>
                                    </form>
                                </td>
                                
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection