@extends('layouts.auth')

@section('content')

    <div class="auth-container">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default panel-auth">
                <div class="panel-heading"><h3 class="panel-title"><strong>Reset password </strong></h3></div>
                <div class="panel-body">
                    <form role="form" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="token" value="{{ $token }}">
                        <div class="{{ $errors->has('email') ? 'form-group has-error' : 'form-group' }}">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control" id="email"
                                   placeholder="Enter email" value="{{ old('email') }}">
                            {!! $errors->first('email', '<span class="help-block">:message</span>') !!}
                        </div>
                        <div class="{{ $errors->has('password') ? 'form-group has-error' : 'form-group' }}">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control"
                                   id="password" placeholder="Password">
                            {!! $errors->first('password', '<span class="help-block">:message</span>') !!}
                        </div>
                        <div class="{{ $errors->has('password_confirmation') ? 'form-group has-error' : 'form-group' }}">
                            <label for="password_confirmation">Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-control" id="password_confirmation"
                                   placeholder="Enter password again">
                            {!! $errors->first('email_confirmation', '<span class="help-block">:message</span>') !!}
                        </div>
                        <button type="submit" class="btn btn-primary btn-block btn-lg">Reset Password</button>
                    </form>
                </div>
            </div>
            <a href="/auth/login">Sing in</a>
        </div>
    </div>

@endsection