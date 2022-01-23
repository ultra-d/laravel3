@extends('layout')

@section('title', 'Crear producto')

@section('content')
<div class="container py-3">
	<div class="row">
		<div class="col-12 col-sm-10 col-lg-6 mx-auto">
			
			@include('partials.validation-errors')
			
			<form class="bg-white shadow rounded py-3 px-4"
				enctype="multipart/form-data"
				method="POST" action="{{ route('products.update', $product) }}">
				@method('PATCH')
				<h1 class="display-4">Editar producto</h1>
				<hr>
				
				@include('products._form', ['btnText' => 'Actualizar'])
			</form>
		</div>
	</div>
</div>

@endsection