@extends('layout')

@section('title', 'Registro')

@section('content')

<div class="container py-3">
	<div class="row">
		<div class="col-12 col-sm-10 col-lg-6 mx-auto">
		
			<form class="bg-white shadow rounded py-3 px-4"
				action="{{ route('register') }}" 
				method="POST">
				@csrf
				<h1 class="display-5">{{__('titles.Register') }}</h1>
				<hr>
				<br>
				<div class="form-group">
					<label for="name">{{ __('form.users.name')}}</label>
					<input class="form-control bg-light shadow-sm
					@error('name') is-invalid @else border-0
					@enderror"
					id="name" 
					type="text" 
					name="name" 
					value="{{ old('name') }}" 
					placeholder="{{ __('form.users.name')}}">
					@error('name')
						<span class="invalid-feedback" role="alert">
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
					<span class="invalid-feedback" role="alert">
						<strong>{{ $message}}</strong>
					</span>
					@enderror
					<br>
				</div>

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
				</div>

				<div class="form-group">
					<label for="password_confirmation">{{ __('form.users.password_confirm')}}</label>
					<input class="form-control bg-light shadow-sm
					@error('password')
					is-invalid @else border-0
					@enderror"
					id="password_confirmation" 
					type="password" 
					name="password_confirmation" 
					placeholder="{{ __('form.users.password_confirm')}}" 
					value="{{ old('password') }}">
					@error('password')
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