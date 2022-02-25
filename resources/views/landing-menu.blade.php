@extends('layout')

@section('title', 'Landing')

@section('content')

<div class="container py-3">

	<div class="form-outline">
			
			<form class="form-inline my-2 my-lg-0 d-flex justify-content-between flex-nowrap" 
			type="get" action="{{ url('/search') }}">
				<input 
					type="search" 
					id="search"
					name="title"
					class="form-control mr-sm-2
					@error('title')
					is-invalid @else border-1
					@enderror" 
					placeholder="{{__('form.products.search_p')}}" 
					aria-label="Search" />
					@error('title')
					<span class="invalid-feedback" role="alert">
						<strong>{{ $message}}</strong>
					</span>
					@enderror

					<select class="form-control border-0 bg-light shadow-sm"
					name="category_id" type="search" id="category_id">
						<option value=""> Categoria </option>
						@foreach ($categories as $id => $name)
						<option value="{{ $id }}"> {{ $name }}</option>	
						@endforeach
					</select>
	
			</form>
	</div>
	
	<div class="d-flex justify-content-between align-items-center">
		<h1 class="display-4 mb-0">Products</h1>
	</div>
	
	<div class="d-flex flex-wrap justify-content-between align-items-start ">
		@forelse($products as $product)
		<div class="card border-0 shadow-sm mt-4 mx-auto" style="width: 18rem;">
			@if($product->image)
				<img class="card-img-top" style="height: 150px; object-fit: cover" src="/storage/{{ $product->image }}" alt="{{ $product->title }}">
			@endif
			
			<div class="card-body">
				<h5 class="card-title">{{ $product->title }}</h5>
				<p class="card-text text-truncate"> {{ $product->description }} </p>
				<h6 class="card-subtitle"> $ {{ $product->price}} </h6>
				<br>
				@if($product->status == false)
				<p>*OUT OF STOCK*</p>
				@endif
				<div class="d-flex justify-content-between align-items-center">
					<span class="badge bg-secondary">
						{{ $product->category ? $product->category->name : '' }}
					</span>
				</div>
			</div>
		</div>
		
		@empty
		<div class="card">
			<div class="card-body">
				No hay productos para mostrar
			</div>
		</div>
		@endforelse
	</div>
	<div class="mt-4">
		{{ $products->links() }}
	</div>
</div>
@endsection
