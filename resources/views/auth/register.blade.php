@extends('layouts.auth')

@section('content')

    <div class="auth-container">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default panel-auth">
                <div class="panel-heading"><h3 class="panel-title"><strong>Sign up </strong></h3></div>
                <div class="panel-body">
                    <form role="form" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="{{ $errors->has('name') ? 'form-group has-error' : 'form-group' }}">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control" id="name"
                                   placeholder="Enter name" value="{{ old('name') }}">
                            {!! $errors->first('name', '<span class="help-block">:message</span>') !!}
                        </div>
                        <div class="{{ $errors->has('email') ? 'form-group has-error' : 'form-group' }}">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control" id="email"
                                   placeholder="Enter email" value="{{ old('email') }}">
                            {!! $errors->first('email', '<span class="help-block">:message</span>') !!}
                        </div>
                        <div class="{{ $errors->has('email_confirmation') ? 'form-group has-error' : 'form-group' }}">
                            <label for="email_confirmation">Retype Email</label>
                            <input type="email" name="email_confirmation" class="form-control" id="email_confirmation"
                                   placeholder="Enter email again">
                            {!! $errors->first('email_confirmation', '<span class="help-block">:message</span>') !!}
                        </div>
                        <div class="{{ $errors->has('password') ? 'form-group has-error' : 'form-group' }}">
                            <label for="password">Password <a href="/auth/forgot-password">(forgot
                                    password)</a></label>
                            <input type="password" name="password" class="form-control"
                                   id="password" placeholder="Password">
                            {!! $errors->first('password', '<span class="help-block">:message</span>') !!}
                        </div>
                        <button type="submit" class="btn btn-danger btn-block btn-lg">Sign up</button>
                    </form>
                </div>
            </div>
            <a href="/auth/login">Sing in</a>
            <a href="/auth/forgot-password" class="pull-right">Forgot password</a>
        </div>
    </div>

@endsection