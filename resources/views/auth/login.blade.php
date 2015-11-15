@extends('layouts.auth')

@section('content')

    <div class="auth-container">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default panel-auth">
                <div class="panel-heading"><h3 class="panel-title"><strong>Sign in </strong></h3></div>
                <div class="panel-body">
                    <form role="form" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="{{ $errors->has('email') ? 'form-group has-error' : 'form-group' }}">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control" id="email"
                                   placeholder="Enter email" value="{{ old('email') }}">
                            {!! $errors->first('email', '<span class="help-block">:message</span>') !!}
                        </div>
                        <div class="{{ $errors->has('password') ? 'form-group has-error' : 'form-group' }}">
                            <label for="password">Password <a href="/auth/forgot-password">(forgot
                                    password)</a></label>
                            <input type="password" name="password" class="form-control"
                                   id="password" placeholder="Password">
                            {!! $errors->first('password', '<span class="help-block">:message</span>') !!}
                        </div>
                        <button type="submit" class="btn btn-success btn-block btn-lg">Sign in</button>
                    </form>
                </div>
            </div>
            <a href="/auth/register">Sing up</a>
            <a href="/auth/forgot-password" class="pull-right">Forgot password</a>
        </div>
    </div>

@endsection