@if($product->images->isNotEmpty())
	@foreach($product->images->chunk(3) as $chunk)
		<div class="row mb-4">
			@foreach ($chunk as $image)
				<div class="col-4">
					<div class="card p-0">
						<img src="{{ $image->url() }}" class="card-img-top" alt="...">
						<div class="card-body">
							<form action="{{ route('admin.images.destroy', $image) }}" method="post">
								@csrf
								@method('DELETE')
								<button type="submit" class="btn btn-danger">Eliminar</button>
							</form>
						</div>
					  </div>
				</div>
			@endforeach
		</div>
	@endforeach
@endif
