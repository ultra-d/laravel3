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
	
	<div class="d-flex flex-wrap justify-content-between align-items-start ">
		@forelse($products as $product)
		
		<div class="card border-0 shadow-sm mt-4 mx-auto" style="width: 18rem;">
			@if($product->image)
<<<<<<< HEAD
			<img class="card-img-top" src="/storage/{{ $product->image }}" alt="{{ $product->title }}">
=======
				<img class="card-img-top" style="height: 150px; object-fit: cover" src="/storage/{{ $product->image }}" alt="{{ $product->title }}">
>>>>>>> feature/add-productcontroller-images
			@endif
			
			<div class="card-body">
				<h5 class="card-title">{{ $product->title }}</h5>
				<p class="card-text text-truncate"> {{ $product->description }} </p>
				<h6 class="card-subtitle"> {{ $product->created_at->format('d/m/Y')}} </h6>
				<a href="{{ route('products.show', $product) }}" class="btn btn-primary">ver más</a>
			</div>
		</div>
		
		@empty
		<div class="card">
			<div class="card-body">
				No hay productos para mostrar
			</div>
		</div>
		@endforelse
		<div class="mt-4">
			{{ $products->links() }}
		</div>
	</div>
</div>
@endsection
