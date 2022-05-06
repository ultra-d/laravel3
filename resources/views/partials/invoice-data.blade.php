@section('content')
<div class="container py-3">
	<div class="row">
		<div class="col-12 col-sm-11 mx-auto"> 	
			<div class="card">
				<div class="d-flex justify-content-between align-items-center ">
					<h1 id="mydesc" class="display-5 mb-0"> Resumen de la compra </h1>
				</div>
				<br>
				<table class="table" aria-describedby="mydesc">
                    <thead>
                        <tr>
                        <th scope="col">{{ __('form.products.short_qty')}}</th>
                        <th scope="col">{{ __('form.products.name')}}</th>
                        <th scope="col">{{ __('form.products.price')}}</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($invoice->products as $product)
                            <tr>
                            <th scope="row">{{ $product->pivot->quantity }}</th>
                            <td>{{ $product->title }}</td>
                            <td>{{ $product->pivot->price * $product->pivot->quantity }}</td>
                            </tr> 
                        @endforeach
                        <td>--</td>
                        <td>--</td>
                        <td>{{ $invoice->total}}</td>
                    
                    </tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@endsection
