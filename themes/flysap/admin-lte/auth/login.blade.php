@extends('themes::layouts.login')

@section('content')

<!-- resources/views/auth/login.blade.php -->
<div class="login-box">
    <div class="login-logo">
        <a href="#"><b>Admin</b>SMG</a>
    </div><!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">{{trans('Login to Backend')}}</p>

        <form action="{{route('post_login')}}" method="post">
            {!! csrf_field() !!}

            <div class="form-group has-feedback">
                <input type="text" class="form-control" placeholder="{{trans('Email')}}" name="email" />
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" class="form-control" placeholder="{{trans('Password')}}" name="password" />
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-8">
                    <div class="checkbox icheck">
                        <label>
                            <input type="checkbox" name="remember"> {{trans('Remember Me')}}
                        </label>
                    </div>
                </div><!-- /.col -->
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">{{trans('Sign In')}}</button>
                </div><!-- /.col -->
            </div>
        </form>
    </div><!-- /.login-box-body -->
</div><!-- /.login-box -->
@endsection