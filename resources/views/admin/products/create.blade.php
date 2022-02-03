@extends('layout')

@section('title', 'Crear producto')

@section('content')
<div class="container py-3">
	<div class="row">
		<div class="col-12 col-sm-10 col-lg-6 mx-auto">
			
			<form class="bg-white shadow rounded py-3 px-4"
			method="POST"
			enctype="multipart/form-data" 
			action="{{ route('admin.products.store') }}">
			
			<h1 class="display-6">Crear nuevo producto</h1>
			
			@include('admin.products._form')
			@include('partials.validation-errors')
			<br>
			<button class="btn btn-primary btn-md w-100">Crear</button>
			<br>
			<a class="btn btn-link w-100" href="{{ route('admin.products.index') }}">Cancelar</a>
		    </form>
	</div>
</div>
</div>

@endsection
