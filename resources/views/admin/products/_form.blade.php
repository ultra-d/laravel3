@csrf

@if($product->image)
<img class="card-img-top" style="height: 250px; object-fit: cover" src="/storage/{{ $product->image }}" alt="{{ $product->title }}">
@endif

<div class="mb-3">
	<label for="formFileSm" class="form-label">Seleccionar producto</label>
	<input name="image" class="form-control form-control-sm" id="formFileSm" type="file">
</div>

<div class="form-group row mb-3">
	<label class="col-sm-2 col-form-label" for="code"> 
		{{ __('form.products.code') }}
	</label>
	<div class="col-sm-10">
		<input class="form-control border-0 bg-light shadow-sm"
		id="code"
		type="text" 
		name="code" 
		value="{{ old('title', $product->code) }}">
	</div>
</div>

<div class="form-group mb-3">
	<label for="title"> 
		{{ __('form.products.title') }}
	</label>
	<input class="form-control border-0 bg-light shadow-sm"
	id="title"
	type="text" 
	name="title" 
	value="{{ old('title', $product->title) }}">
</div>

<div class="form-group mb-3">
	<label for="url">
		{{ __('form.products.url') }} 
	</label>
	<input class="form-control border-0 bg-light shadow-sm"
	id="url"
	type="text" 
	name="url" 
	value="{{ old('url', $product->url) }}">
</div>

<div class="form-group row mb-3">
	<label class="col-sm-2 col-form-label" for="price">
		{{ __('form.products.price') }} 
	</label>
	<div class="col-sm-10">
		<input class="form-control border-0 bg-light shadow-sm"
		id="price"
		type="number" 
		name="price" 
		value="{{ old('price', $product->price) }}">
	</div>
</div>

<div class="form-group row mb-3">
	<label class="col-sm-2 col-form-label" for="quantity">
		{{ __('form.products.quantity') }} 
	</label>
	<div class="col-sm-10">
		<input class="form-control border-0 bg-light shadow-sm"
		id="quantity"
		type="number" 
		name="quantity" 
		value="{{ old('quantity', $product->quantity) }}">
	</div>
</div>

<div class="form-group mb-3">
	<label>
		{{ __('form.products.description') }}  
	</label>
	<textarea class="form-control border-0 bg-light shadow-sm"
	name="description">{{ old('description', $product->description) }}
</textarea>
</div>
<br>
