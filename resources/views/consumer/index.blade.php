@extends('layouts.master')

@section('content')

    <div class="page-header">
        <h1>Applications <a href="/consumer/create" class="btn btn-default pull-right">Create New App</a></h1>
    </div>

    @foreach($consumers as $consumer)
        <div class="consumer-item">
            <h3>
                <span class="glyphicon glyphicon-fire consumer-icon" aria-hidden="true"></span>
                <a href="/consumer/{{ $consumer->id }}">{{ $consumer->name }}</a>
            </h3>
            <p>{{ $consumer->description }}</p>
        </div>
    @endforeach

@endsection