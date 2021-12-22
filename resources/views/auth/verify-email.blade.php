@extends('layout')

@section('title', 'Email verification')

@section('content')

<h1>Email verification.</h1>

Before proceeding, you must verify your account, check your email for a verification link: <br> To resend the verification link <form class="d-inline" method="POST" action="{{ route('verification.send') }}">
	@csrf <input type="submit" value="click here.">
</form>

@endsection