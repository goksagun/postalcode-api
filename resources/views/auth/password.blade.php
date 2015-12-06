@extends('layouts.auth')

@section('content')

    <div class="auth-container">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default panel-auth">
                <div class="panel-heading"><h3 class="panel-title"><strong>Reset Password </strong></h3></div>
                <div class="panel-body">
                    <form role="form" method="post">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="{{ $errors->has('email') ? 'form-group has-error' : 'form-group' }}">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control" id="email"
                                   placeholder="Enter email" value="{{ old('email') }}">
                            {!! $errors->first('email', '<span class="help-block">:message</span>') !!}
                        </div>
                        <button type="submit" class="btn btn-success btn-block btn-lg">Send Reset Code</button>
                    </form>
                </div>
            </div>
            <a href="/auth/register">Sing up</a>
        </div>
    </div>

@endsection