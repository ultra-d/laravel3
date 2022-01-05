@extends('layout')

@section('title', 'Home')

@section('content')
	<div class="container py-3">
		<h1>Bienvenido a mercatodo</h1>
		@include('partials.session-status')
		@auth
			Bienvenido, {{ auth()->user()->name }}!
			@else
			<p> Por favor registrate o inicia sesión </p>
		@endauth
	</div>
	
@endsection