@extends('layouts.auth.main')

@section('title')
    <title>{{ env('APP_NAME') }} - Register</title>
@endsection

@section('content')
    <div class="register-box-body">
        <p class="login-box-msg">Register a new membership</p>
        <form method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}">
            @csrf
            @if ($errors->has('name'))
                <div class="alert alert-danger alert-dismissible">
                    <strong>{{ $errors->first('name') }}</strong>
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
                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" placeholder="{{ __('Name') }}" required autofocus>
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
             </div>
            <div class="form-group has-feedback">
                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="{{ __('Email') }}" required>
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="{{ __('Password') }}" required>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="{{ __('Retype password') }}" required>
                <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
                </div>
            </div>
        </form>
        <br>
        <a href="{{ route('login') }}" class="text-center">I already have a membership</a>
    </div>
@endsection
