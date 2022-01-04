@extends('layout')

@section('content')
@if (session('error'))
   <div class="alert alert-danger">
        {{ session('error') }}
   </div>
@endif
<form action="{{ route('login') }}" method="POST">
	@csrf

	<label>
		<input type="email" name="email" value="{{ old('email') }}" placeholder="Email...">
		@error('email') <div>{{ $message }}</div> @enderror
	</label>

	<label>
		<input type="password" name="password" placeholder="Password...">
		@error('password') <div>{{ $message }}</div> @enderror
	</label>
	<input type="submit" value="Login">
</form>
@endsection
