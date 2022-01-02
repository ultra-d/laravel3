@extends('layout')

@section('title', 'Crear producto')

@section('content')
	<h1>Editar proyecto</h1>

	@include('partials.validation-errors')

	<form method="POST" action="{{ route('products.update', $product) }}">
		@method('PATCH')

		@include('products._form', ['btnText' => 'Actualizar'])
	</form>

@endsection