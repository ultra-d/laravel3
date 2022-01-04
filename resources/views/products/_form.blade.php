@csrf

<label>
	{{ __('form.products.title') }} 
	<br>
	<input type="text" name="title" value="{{ old('title', $product->title) }}">
</label>
<br>
<label>
	Descripcion <br>
	<textarea name="description">{{ old('description', $product->description) }}</textarea>
</label>
<br>
<label>
	URL <br>
	<input type="text" name="url" value="{{ old('url', $product->url) }}">
</label>
<br>
<button>{{ $btnText }}</button>