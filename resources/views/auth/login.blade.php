@extends('layouts.auth.main')

@section('title')
    <title>{{ env('APP_NAME') }} - Login</title>
@endsection

@section('content')
    <div class="login-box-body">
        <p class="login-box-msg">Sign in to start your session</p>
        <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
            @csrf
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            @if ($errors->has('email'))
                <div class="alert alert-danger alert-dismissible">
                    <strong>{{ $errors->first('email') }}</strong>
                </div>
            @endif
            @if ($errors->has('password'))
                <div class="alert alert-danger alert-dismissible">
                    <strong>{{ $errors->first('password') }}</strong>
                </div>
            @endif
            <div class="form-group has-feedback">
                <input id="email" type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email') }}" value="{{ old('email') }}" required autofocus>
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input id="password" type="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('Password') }}">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                </div>
            </div>
        </form>
        <br>
        <a href="{{ route('register') }}" class="text-center">Don't have an account?</a>
    </div>
@endsection
