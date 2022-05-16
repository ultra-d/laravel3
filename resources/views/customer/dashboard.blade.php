@extends('layout')

@section('title', 'Dashboard')

@section('content')

@if (session('message'))
	<div>{{ session('message') }}</div>
@endif

<div class="container py-3">
	
	<div class="d-flex justify-content-between align-items-center">
		<h1 class="display-4 mb-2">Products</h1>
	</div>

    <div class="form-outline">
        <form class="form-inline my-2 my-lg-0 d-flex justify-content-between flex-nowrap" 
        type="get" action="{{ url('/items/search') }}">
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
        </form>
    </div>

	<div class="d-flex flex-wrap justify-content-between align-items-start ">
		@forelse($products as $product)
		<div class="card border-0 shadow-sm mt-4 mx-auto p-0" style="width: 18rem;">
			@if($product->images->isNotEmpty())
			<div id="carouselExampleControls-{{ $loop->iteration }}" class="carousel slide card-img-top" data-bs-ride="carousel">
				<div class="carousel-inner">
					@foreach($product->images as $image )
						<div @class(['carousel-item', 'landing-img', 'active' => $loop->first])>
							<img src="{{ $image->url() }}" class="d-block w-100" alt="{{ $product->title }}">
						</div>
					@endforeach
				</div>
				<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls-{{ $loop->iteration }}" data-bs-slide="prev">
				  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
				  <span class="visually-hidden">Previous</span>
				</button>
				<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls-{{ $loop->iteration }}" data-bs-slide="next">
				  <span class="carousel-control-next-icon" aria-hidden="true"></span>
				  <span class="visually-hidden">Next</span>
				</button>
			  </div>
			@endif

			<div class="card-body">
				<h5 class="card-title">{{ $product->title }}</h5>
				<p class="card-text text-truncate"> {{ $product->description }} </p>
				<h6 class="card-subtitle"> $ {{ $product->price}} </h6>
				<br>
				<div class="d-flex justify-content-between align-items-center">
					<span class="badge bg-secondary">
						{{ $product->category ? $product->category->name : '' }}
					</span>
					@if($product->status == false)
						disable
					@elseif ($product->quantity == 0)
						sin stock
					@else
						<add-product-button :product='@json($product)'></add-product-button>
					@endif
					
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
