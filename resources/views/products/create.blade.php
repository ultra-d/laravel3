@extends('layout')

@section('title', 'Crear producto')

@section('content')
<div class="container py-3">
	<div class="row">
		<div class="col-12 col-sm-10 col-lg-6 mx-auto">
			
			@include('partials.validation-errors')
			
			<form class="bg-white shadow rounded py-3 px-4"
			method="POST" 
			action="{{ route('products.store') }}">

			<h1 class="display-6">Crear nuevo producto</h1>
			
			@include('products._form', ['btnText' => 'Guardar'])	
		</form>
	</div>
</div>
</div>

@endsection