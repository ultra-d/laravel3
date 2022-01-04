@extends('layout')

@section('title', 'Create New User')
<link href="{{ asset('css/app.css') }}" rel="stylesheet">

@section('content')
<h1>
    {{ __('messages.users.create') }}
</h1>
<form action="{{ route('admin.users.store') }}" method="POST">
    @include('admin.users.partials.form', ['create' => true])
</form>
@endsection