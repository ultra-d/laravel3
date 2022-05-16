@extends('layout')

@section('title', trans('titles.admin_product'))
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
@section('content')
<div class="container py-3">
	<div class="row">
		<div class="col-12 col-sm-11 mx-auto">
			<div class="card">

				@if (Session::has('message'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <p>{{ Session::get('message') }}</p>
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

				<div class="d-flex justify-content-between align-items-center ">
					<h1 id="mydesc" class="display-5 mb-0"> {{ trans('titles.products_panel')}}</h1>
					<a class="btn btn-primary btn-sm btn-success" href="{{ route('admin.products.create') }}" role="button">{{ trans('form.products.create')}}</a>
				</div>
				<br>
				<table class="table" aria-describedby="mydesc">
				<thead>
					<tr>
					<th scope="col">#ID</th>
					<th scope="col">{{ trans('form.products.name')}}</th>
					<th scope="col">{{ trans('form.products.description')}}</th>
					<th scope="col">{{ trans('form.products.short_qty')}}</th>
					<th scope="col">{{ trans('form.products.price')}}</th>
					<th scope="col">{{ trans('form.products.category')}}</th>
					<th scope="col">{{ trans('form.products.stock')}}</th>
					<th scope="col">{{ trans('form.products.manage')}}</th>
					</tr>
				</thead>
				<tbody>
				@foreach($products as $product)
					<tr>
					<th scope="row">{{ $product->id }}</th>
					<td>{{ $product->title }}</td>
					<td>{{ $product->description }}</td>
					<td>{{ $product->quantity }}</td>
					<td>{{ $product->price }}</td>
					<td>{{ $product->category->name }}</td>
					<td>@if( $product->status == 1) {{ 'Enabled' }} @else {{ 'Disabled' }} @endif</td>
					<td>
						<a class="btn btn-sm btn-primary" 
						href="{{ route('admin.products.edit', $product) }}" 
						role="button">{{ trans('form.button.edit')}}</a>

						<button 
						type="button" 
						class="btn btn-sm btn-danger" 
						onclick="event.preventDefault(); document.getElementById('delete-product-form-{{ $product->id }}').submit()">
						{{ trans('form.button.delete')}}
						</button>

						<form id="delete-product-form-{{ $product->id }}"
						action="{{ route('admin.products.destroy', $product) }}"
						method="POST" 
						style="display: none">
						@method("DELETE")
						@csrf
						</form>
					</td>
					</tr>
				@endforeach
				</tbody>
				</table>
				{{ $products->links() }}
			</div>
		</div>
	</div>
</div>
@endsection
