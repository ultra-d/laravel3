@extends('layout')

@section('title', 'Password reset')

@section('content')

<h1>Reset password.</h1>
<form metho="POST" action="{{ route('password.update') }}" >
	@csrf
	<input type="hidden" name="token" value="{{ request()->token }}">

	Email address: <br>
	<label>
		<input type="email" name="email" value="{{ old('email') }}">
		@error('email') <div>{{ $message }}</div> @enderror
	</label>
	New password: <br>
	<label>
		<input type="password" name="password" placeholder="Password...">
		@error('password') <div>{{ $message }}</div> @enderror
	</label>
	<br>
	Password confirmation: <br>
	<label>
		<input type="password" name="password_confirmation">
		@error('password') <div>{{ $message }}</div> @enderror
	</label>
	<br>
	<br>
	<input type="submit" value="Send Password Reset Link">
</form>


@endsection