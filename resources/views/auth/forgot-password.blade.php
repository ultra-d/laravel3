@extends('layout')

@section('title', 'Password forgot')

@section('content')

<div class="container py-3">
	<div class="row">
		<div class="col-12 col-sm-10 col-lg-6 mx-auto">
			<form class="bg-white shadow rounded py-3 px-4"
				method="POST" action="{{ route('password.email') }}" >
				@csrf
				<h1 class="display-5">Forgot Password</h1>
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
					<span class="invalid-feedback" role="alert">
						<strong>{{ $message}}</strong>
					</span>
					@enderror
					<br>
				</div>
				<button class="btn btn-primary btn-md w-100">
					{{ __('form.button.send')}}
				</button>
			</form>
		</div>
	</div>
</div>

@endsection