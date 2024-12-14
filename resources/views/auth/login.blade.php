@extends('layouts.app-login')

@section('content')
    <form class="login-form" method="POST" action="{{ route('login') }}">
        @csrf
        <h3 class="form-title">Login to your account</h3>
        <div class="alert alert-danger display-hide">
            <button class="close" data-close="alert"></button>
            <span>Enter any username and password.</span>
        </div>
        <div class="form-group">
            <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
            <label class="control-label visible-ie8 visible-ie9">Username</label>
            <div class="input-icon">
                <i class="fa fa-user"></i>
{{--                <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Username" name="username"/>--}}
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                       autocomplete="off" placeholder="Username" value="{{ old('email') }}" required autocomplete="email" autofocus>

                @error('email')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Password</label>
            <div class="input-icon">
                <i class="fa fa-lock"></i>
{{--                <input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password"/>--}}
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <div class="form-actions">
            <label class="checkbox">
                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>{{ __('Remember Me') }}
            </label>
            <button type="submit" class="btn green pull-right">
                {{ __('Login') }} <i class="m-icon-swapright m-icon-white"></i>
            </button>
        </div>
        <div class="forget-password">
            <h4>Login for POS transaction</h4>
            click <a href="{{ 'signin' }}"  id="forget-password">here</a>

        </div>
    </form>
@endsection
