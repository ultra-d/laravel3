@csrf

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
<br>

<button class="btn btn-primary btn-lg btn-block">{{ $btnText }}</button>
