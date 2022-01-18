@extends('layout')

@section('title', 'Portafolio')

@section('content')

<div class="container py-3">
	<div class="d-flex justify-content-between align-items-center">
		<h1 class="display-4 mb-0">Portafolio</h1>
		@auth
		<a class="btn btn-primary btn-sm btn-success" href="{{ route('products.create') }}" role="button">{{ __('form.products.create')}}</a>
		@endauth
	</div>
	<ul class="list-group py-3">
		@forelse($products as $product)
		<li class="list-group-item border-0 mb-3 shadow-sm">
			<a class="text-secondary justify-content-between align-items-center d-flex" href="{{ route('products.show', $product) }}">
				<span class="font-weight-bold">
					{{ $product->title }}
				</span>
				<span class="text-black-50">
					{{ $product->created_at->format('d/m/Y')}}
				</span>
			</a><br>
		</li>
		@empty
		<li class="list-group-item border-0 mb-3 shadow-sm">No hay productos para mostrar</li>
		@endforelse
		{{ $products->links() }}
	</ul>
	
</div>
@endsection