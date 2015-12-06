@extends('layouts.master')

@section('content')

    <div class="page-header">
        <h1>{{ $consumer->name }}</h1>
    </div>

    @include('consumer.shared.nav')

    <h3>Application Settings</h3>
    <p class="text-muted">Your application's Consumer Key and Secret are used to authenticate requests to the Postal Code API Platform.</p>

    <table class="table">
        <tr>
            <td>Consumer Key (API Key)</td>
            <td>{{ $consumer->api_key }}</td>
        </tr>
        <tr>
            <td>Consumer Secret (API Secret)</td>
            <td>{{ $consumer->api_secret }}</td>
        </tr>
        <tr>
            <td>Owner</td>
            <td>{{ $consumer->user->email }}</td>
        </tr>
        <tr>
            <td>Owner ID</td>
            <td>{{ $consumer->user->id }}</td>
        </tr>
    </table>

    <div class="well">
        <h4>Application Actions</h4>

        <a href="/consumer/{{ $consumer->id }}/recreate-keys" class="btn btn-default">Regenerate Consumer Key and Secret</a>
    </div>

    <h3>Your Access Token</h3>
    <p class="text-muted">This access token can be used to make API requests on your own account's behalf. Do not share your access token secret with anyone.</p>

    @if($token)
    <table class="table">
        <tr>
            <td>Access Token</td>
            <td>{{ $token->access_key }}</td>
        </tr>
        <tr>
            <td>Access Token Secret</td>
            <td>{{ $token->access_secret }}</td>
        </tr>
        <tr>
            <td>Owner</td>
            <td>{{ $consumer->user->email }}</td>
        </tr>
        <tr>
            <td>Owner ID</td>
            <td>{{ $consumer->user->id }}</td>
        </tr>
    </table>
    @endif

    <div class="well">
        <h4>Token Actions</h4>

        @if($token)
            <a href="/consumer/{{ $consumer->id }}/recreate-tokens/{{ $token->id }}" class="btn btn-default">Regenerate My Access Token and Token Secret</a>
            <a href="/consumer/{{ $consumer->id }}/revoke-tokens/{{ $token->id }}" class="btn btn-default">Revoke Token Access</a>
        @else
            <a href="/consumer/{{ $consumer->id }}/create-tokens" class="btn btn-default">Generate My Access Token and Token Secret</a>
        @endif
    </div>

@endsection