@extends('layout')

@section('title', 'Edit user')
<link href="{{ asset('css/app.css') }}" rel="stylesheet">

@section('content')
<div class="container py-3">
    <div class="row">
        <div class="col-12 col-sm-10 col-lg-6 mx-auto">
            <form class="bg-white shadow rounded py-3 px-4"
            action="{{ route('admin.users.update', $user) }}" method="POST">
            <h1 class="display-6"> {{__('messages.users.edit') }}</h1>
            @method('PATCH')
            @include('admin.users.partials.form')
            <strong>{{ __('form.users.status') }}</strong>
            <div>
                <input class="form-check-input border-0.03 shadow" type="checkbox" id="disable" name="disable" {{ $user->isDisabled() ? 'checked' : '' }}>
                <label class="form-check-label" for="disable"> {{ __('form.users.disable') }}</label>
            </div>
            <br>
            <button class="btn btn-primary btn-md w-100">
                {{ __('form.button.save')}}
            </button>
            
        </form>
    </div>
</div>
</div>
@endsection