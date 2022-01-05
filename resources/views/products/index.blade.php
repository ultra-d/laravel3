@extends('layout')

@section('title', 'Portafolio')

@section('content')
	<h1>EN CONSTRUCCIÓN</h1>
	<h1>Portafolio</h1>
	<a href="{{ route('products.create') }}">Crear producto</a>
	<ul>

		@forelse($products as $product)
			<li><a href="{{ route('products.show', $product) }}">{{ $product->title }}</a><br></li>
		@empty
			<li>No hay productos para mostrar</li>
		@endforelse
		{{ $products->links() }}
	</ul>
@endsection