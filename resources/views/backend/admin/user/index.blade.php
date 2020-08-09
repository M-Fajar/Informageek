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
                                <th>Nama</th>
                                <th>Email</th>
                                <th>User Name</th>
                                <th>Tipe User</th>
                                <th width="10%">Aksi</th>
                                <th width="10%">Hapus</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $no = 0;?>
                           @foreach ( $users->sortBy('id') as $item)
                        <?php $no++ ;?> 
                            <tr>
                                <td>{{$no}}</td>
                                <td>{{$item->name}} </td>
                                <td>{{$item->email}}</td>
                                <td>{{$item->username}}</td>
                                <td> 
                                    {{$item->getRoleNames()[0]}}
                                </td>
                                @if($item->getRoleNames()[0] != 'admin')
                                <td>
                                    <a href="/admin/userupdate/{{ $item->id }}" class="btn btn-warning">EDIT</a>
                                </td>
                                <td>
                                    <form action="/admin/userdelete/{{ $item->id }}" method = "post" onsubmit= "return confirm('Yakin menghapus data tersebut ?')">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button href="#" class="btn btn-danger">DELETE</button>
                                    </form>
                                </td>
                                @endif
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