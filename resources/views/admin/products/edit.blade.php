@extends('layout')

@section('title', 'Crear producto')

@section('content')
<div class="container py-3">
	<div class="row">
		<div class="col-12 col-sm-10 col-lg-6 mx-auto">
			
			@include('partials.validation-errors')
			<h1 class="display-4">Editar producto</h1>
			<hr>
			@include('admin.products.images')
			<form class="bg-white shadow rounded py-3 px-4"
			enctype="multipart/form-data"
			method="POST" 
			action="{{ route('admin.products.update', $product) }}">
			@method('PATCH')
			
			@include('admin.products._form')
			
			<div>
				<input class="form-check-input border-0.03 shadow" type="checkbox" id="disable" name="disable" {{ $product->isDisabled() ? 'checked' : '' }}>
				<label class="form-check-label" for="disable"> {{ __('form.products.disable') }}</label>
			</div>
			<br>
			<button class="btn btn-primary btn-md w-100">Actualizar</button>
			<br>
			<a class="btn btn-link w-100" href="{{ route('admin.products.index') }}">Cancelar</a>
		</form>
	</div>
</div>
</div>

@endsection
