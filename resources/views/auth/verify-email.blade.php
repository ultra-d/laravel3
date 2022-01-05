@extends('layout')

@section('title', 'Email verification')

@section('content')

<div class="container py-3">
	<div class="row">
		<div class="col-12 col-sm-10 col-lg-6 mx-auto">
			<h1>{{ __('messages.form.verify_email') }}</h1>
			<p>{{ __('messages.form.verify_email_text') }} </p>
			{{ __('messages.form.verify_email_resend') }}
			<form class="d-inline" method="POST" action="{{ route('verification.send') }}">
				@csrf 
				<br>
				<button class="btn btn-primary btn-sm btn">
					{{ __('form.button.click')}}
				</button>
			</form>

@endsection