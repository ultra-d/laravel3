@extends('layout')

@section('title', 'Registro')

@section('content')

	<h1>{{__('Registro') }}</h1>
	<form action="{{ route('register') }}" method="POST">
		@csrf
		Name <br>
		<label>
			<input type="text" name="name" value="{{ old('name') }}" placeholder="Nombre...">
			@error('name') <div>{{ $message }}</div> @enderror
		</label>
		<br>
		Email <br>
		<label>
			<input type="email" name="email" value="{{ old('email') }}" placeholder="Email...">
			@error('email') <div>{{ $message }}</div> @enderror
		</label>
		<br>
		Password <br>
		<label>
			<input type="password" name="password" placeholder="Password...">
			@error('password') <div>{{ $message }}</div> @enderror
		</label>
		<br>
		Password confirmation <br>
		<label>
			<input type="password" name="password_confirmation">
			@error('password') <div>{{ $message }}</div> @enderror
		</label>
		<br>
		<input type="submit" value="Register">
	</form>


@endsection