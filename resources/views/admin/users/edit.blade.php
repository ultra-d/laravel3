@extends('layout')

@section('title', 'Edit user')
<link href="{{ asset('css/app.css') }}" rel="stylesheet">

@section('content')
<div>
    <h1>
        <h1 class="float-left"> {{__('messages.users.edit') }}</h1>
    </h1>
</div>
<div>
    <form action="{{ route('admin.users.update', $user) }}" method="POST">
        @method('PATCH')
        @include('admin.users.partials.form', ['edit' => true])
    </form>
</div>
@endsection