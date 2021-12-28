@extends('layout')

@section('title', 'Create new user')

@section('content')
<h1>
    {{__('Create new user') }}
</h1>
<form action="{{ route('admin.users.store') }}" method="POST">
    @include('admin.users.partials.form', ['create' => true])
</form>
@endsection