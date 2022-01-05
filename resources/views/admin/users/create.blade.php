@extends('layout')

@section('title', 'Create New User')
<link href="{{ asset('css/app.css') }}" rel="stylesheet">

@section('content')
<div class="container">
	<div class="row">
		<div class="col-12 col-sm-10 col-lg-6 mx-auto">
            <form class="bg-white shadow rounded py-3 px-4"
                action="{{ route('admin.users.store') }}" 
                method="POST">
                <h1 class="display-6"> {{ __('messages.users.create') }} </h1>
                <hr>
                @include('admin.users.partials.form', ['create' => true])
            </form>
        </div>
    </div>
</div>
@endsection