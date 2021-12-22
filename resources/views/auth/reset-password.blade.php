@extends('layout')

@section('title', 'Password reset')

@section('content')

<h1>Reset password.</h1>
<form method="POST" action="{{ route('password.update') }}" >
	@csrf
	<input type="hidden" name="token" value="{{ request()->token }}">

	Email address: <br>
	<label>
		<input type="email" name="email" value="{{ request()->email ?? old('email') }}">
		@error('email') <div>{{ $message }}</div> @enderror
	</label>
	<br>
	New password: <br>
	<label>
		<input type="password" name="password" placeholder="Password...">
		@error('password') <div>{{ $message }}</div> @enderror
	</label>
	<br>
	Password confirmation: <br>
	<label>
		<input type="password" name="password_confirmation" placeholder="Password...">
		@error('password') <div>{{ $message }}</div> @enderror
	</label>
	<br>
	<br>
	<input type="submit" value="Reset Password">
</form>


@endsection