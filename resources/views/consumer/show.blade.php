@extends('layouts.master')

@section('content')

    <div class="page-header">
        <h1>{{ $consumer->name }}</h1>
    </div>

    @include('consumer.shared.nav')

    <span class="glyphicon glyphicon-fire consumer-icon consumer-icon-sm pull-left" aria-hidden="true"></span>
    <p>{{ $consumer->description }}</p>

    <p><a href="{{ $consumer->website }}" target="_blank">{{ $consumer->website }}</a></p>

    <h3>Organization</h3>
    <p class="text-muted">Information about the organization or company associated with your application. This information is optional.</p>

    <table class="table">
        <tr>
            <td>Organization</td>
            <td>None
        <tr>
            <td>Organization website</td>
            <td>None</td>
        </tr>
    </table>

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
    </table>

    <a href="/consumer/delete/{{ $consumer->id }}" class="btn btn-danger">Delete Application</a>

@endsection