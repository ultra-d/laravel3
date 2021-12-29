@extends('layout')

@section('title', 'Edit user')

@section('content')
<h1>
    {{__('Edit User') }}
</h1>
<form action="{{ route('admin.users.update', $user) }}" method="POST">
    @method('PATCH')
    @include('admin.users.partials.form', ['edit' => true])
</form>
@endsection