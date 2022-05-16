@extends('layout')

@section('title', 'Contact')

@section('content')
<div class="container py-3">
	<div class="row">
		<div class="col-12 col-sm-10 col-lg-6 mx-auto">
			<form class="bg-white shadow rounded py-3 px-4"
			method="POST" 
			action="{{ route('messages.store') }}">
			@csrf
			<h1 class="display-5">{{ __('form.fields.contact') }}</h1>
			<hr>
			<div class="form-group">
				<label for="name">{{ __('form.users.name')}}</label>
				<input class="form-control bg-light shadow-sm 
				@error('name') is-invalid @else border-0
				@enderror"
				id="name" 
				name="name" 
				placeholder="{{ __('form.users.name')}}" 
				value="{{ old('name') }}">
				@error('name')
				<span class="invalid-feedback" role="alert">>
					<strong>{{ $message}}</strong>
				</span>
				@enderror
				<br>
			</div>
			
			<div class="form-group">
				<label for="email">{{ __('form.users.email')}}</label>
				<input class="form-control bg-light shadow-sm
				@error('email')
				is-invalid @else border-0
				@enderror"
				id="email" 
				type="email" 
				name="email" 
				placeholder="{{ __('form.users.email')}}" 
				value="{{ old('email') }}">
				@error('email')
				<span class="invalid-feedback" role="alert">>
					<strong>{{ $message}}</strong>
				</span>
				@enderror
				<br>
			</div>
			
			<div class="form-group">
				<label for="subject">{{ __('form.fields.subject') }}</label>
				<input class="form-control bg-light shadow-sm
				@error('subject')
				is-invalid @else border-0
				@enderror"
				id="subject"
				name="subject" 
				placeholder="{{ __('form.fields.subject') }}" 
				value="{{ old('subject') }}">
				@error('subject')
				<span class="invalid-feedback" role="alert">>
					<strong>{{ $message}}</strong>
				</span>
				@enderror
				<br>
			</div>
			
			<div class="form-group">
				<label for="content">{{ __('form.fields.content') }}</label>
				<textarea class="form-control bg-light shadow-sm
				@error('content')
				is-invalid @else border-0
				@enderror"
				id="content"
				name="content" 
				placeholder="{{ __('messages.form.content') }}"> {{ old('content') }}</textarea>
				@error('content')
				<span class="invalid-feedback" role="alert">>
					<strong>{{ $message}}</strong>
				</span>
				@enderror
				<br>
				
				<button class="btn btn-primary btn-lg w-100">
					{{ __('form.button.send')}}
				</button>
				
			</form>
			
		</div>
	</div>
</div>
@endsection