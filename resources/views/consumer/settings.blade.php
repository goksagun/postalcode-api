@extends('layouts.master')

@section('content')

    <div class="page-header">
        <h1>{{ $consumer->name }}</h1>
    </div>

    @include('consumer.shared.nav')

    @include('consumer.form.create')

@endsection