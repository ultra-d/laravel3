@extends('layout')

@section('title', 'Crear producto')

@section('content')
	<h1>Crear nuevo producto</h1>

	@include('partials.validation-errors')

	<form method="POST" action="{{ route('products.store') }}">

		@include('products._form', ['btnText' => 'Guardar'])


	</form>

@endsection