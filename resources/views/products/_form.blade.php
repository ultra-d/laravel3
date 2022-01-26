@csrf

@if($product->image)
	<img class="card-img-top" style="height: 250px; object-fit: cover" src="/storage/{{ $product->image }}" alt="{{ $product->title }}">
@endif
		
<div class="mb-3">
	<label for="formFileSm" class="form-label">Seleccionar producto</label>
	<input name="image" class="form-control form-control-sm" id="formFileSm" type="file">
  </div>

<div class="form-group">
	<label for="title"> 
		{{ __('form.products.title') }}
	</label>
	<input class="form-control border-0 bg-light shadow-sm"
		id="title"
		type="text" 
		name="title" 
		value="{{ old('title', $product->title) }}">
</div>

<div class="form-group">
	<label>
		{{ __('form.products.description') }}  
	</label>
	<textarea class="form-control border-0 bg-light shadow-sm"
		name="description">{{ old('description', $product->description) }}</textarea>
</div>

<div class="form-group">
	<label>
		{{ __('form.products.url') }} 
	</label>
	<input class="form-control border-0 bg-light shadow-sm"
		id="url"
		type="text" 
		name="url" 
		value="{{ old('url', $product->url) }}">
</div>

<div class="form-group">
	<label>
		{{ __('form.products.price') }} 
	</label>
	<input class="form-control border-0 bg-light shadow-sm"
		id="price"
		type="text" 
		name="price" 
		value="{{ old('price', $product->price) }}">
</div>
<br>

<button class="btn btn-primary btn-md w-100">{{ $btnText }}</button>
<br>
<a class="btn btn-link w-100" href="{{ route('products.index') }}">Cancelar</a>
