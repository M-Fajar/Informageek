@extends('backend.layouts.app', ['navbar' => false])
@section('title', 'Register')

@section('content')
<section class="fs-sec">
    <div class="bg" style="background-image: url({{ url('media/bg.jpg') }});">
        <div class="overlay"></div>
        <div class="caption">
            <h1>Welcome to {{config('app.name')}}</h1>
            <p class="lead">Let's waste your time on some unimportant Post here</p>
            <div class="cta">
                <a href="#" class="btn btn-primary">Learn More</a>
            </div>
        </div>
    </div>
    <div class="panel">
        <div class="panel-body">        
            <div class="brand">
                <a href="{{ route('home') }}">
                    <img src="{{url(config('app.logo'))}}" alt="Logo">
                </a>
            </div>
            <form method="POST" action="{{ route('register') }}">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="name" class="control-label">Name</label>

                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email" class="control-label">E-Mail Address</label>

                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password" class="control-label">Password</label>

                    <input id="password" type="password" class="form-control" name="password" required>

                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="password-confirm" class="control-label">Confirm Password</label>

                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                </div>

                <div class="form-group text-right">
                    <div class="pull-left text-left" style="width: 170px;">
                        <small>By register you agree with our terms and conditions</small>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        Register
                    </button>
                </div>
            </form>
        </div>
        <div class="panel-footer">
            Already have an account? <a href="{{route('login')}}">Login</a>
        </div>
    </div>
</section>

@endsection
