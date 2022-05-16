@extends('layout')

@section('title', 'Create New User')
<link href="{{ asset('css/app.css') }}" rel="stylesheet">

@section('content')
<div class="container py-3">
	<div class="row">
		<div class="col-12 col-sm-10 col-lg-6 mx-auto">
            <form class="bg-white shadow rounded py-3 px-4"
                action="{{ route('admin.users.store') }}" 
                method="POST">
                <h1 class="display-6"> {{ __('messages.users.create') }} </h1>
                <hr>
                @include('admin.users.partials.form')
                <div class="form-group">
                    <label for="password">{{ __('form.users.password')}}</label>
                    <input class="form-control bg-light shadow-sm
                    @error('password')
                    is-invalid @else border-0
                    @enderror"
                    id="password"
                    type="password" 
                    name="password" 
                    placeholder="{{ __('form.users.password')}}" 
                    value="{{ old('password') }}">
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message}}</strong>
                    </span>
                    @enderror
                    <br>
                    <button class="btn btn-primary btn-md w-100">
                        {{ __('form.button.save')}}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection