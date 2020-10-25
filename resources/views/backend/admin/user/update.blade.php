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
                            <form action="/admin/user/user-register-update/{{ $users->id }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}
                                <div class="form-group">
                                    <label class="col-form-label">Nama</label>
                                    <input type="text" readonly class="form-control-plaintext" value="{{ $users->name }}">
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">Email Terdaftar</label>
                                    <input type="text" readonly class="form-control-plaintext" value="{{ $users->email }}">
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">User Name</label>
                                    <input type="text" readonly class="form-control-plaintext" value="{{ $users->username }}">
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">Masukan Tipe User </label>
                                    <select name= "roles-user"class="form-control">
                                        <option value ="user">user</option>
                                        <option value ="userplus">userplus</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-success">Confirm</button>
                                <a href="/admin/user" class="btn btn-danger">Cancel</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection