@extends('layout')

@section('title', 'Password forgot')

@section('content')

<h1>Password forgot.</h1>

<form method="POST" action="{{ route('password.email') }}" >
	@csrf
	Email address: <br>
	<label>
		<input type="email" name="email" value="{{ old('email') }}">
		@error('email') <div>{{ $message }}</div> @enderror
	</label>
	<br>
	<input type="submit" value="Send Password Reset Link">
</form>


@endsection