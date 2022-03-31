@extends('layout')

@section('title', 'Cart')

@section('content')

<div class="container mb-4">
    <main>
        <div class="py-5 text-center">
            <h2>Checkout form</h2>
        </div>
        
        <div class="row g-5">
            <div class="col-md-5 col-lg-4 order-md-last">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-primary">Your cart</span>
                    <span class="badge bg-primary rounded-pill">{{ \Gloudemans\Shoppingcart\Facades\Cart::content()->count() }}</span>
                </h4>
                 <!-- Products in cart resume -->
                <ul class="list-group mb-3">
                    @foreach($cart as $cartItem)
                    <li class="list-group-item d-flex justify-content-between lh-sm">
                        <div>
                            <h6 class="my-0">{{ $cartItem->name}}</h6>
                            <hr class="my-1">
                            <!-- Commented code to update number of items -->

                            {{-- <small><input type="number" name="quantity" value="{{ $cartItem->qty}}"
                                min="1" max="{{$cartItem->options->max}}"
								class="text-sm sm:text-base px-2 pr-2 rounded-lg border 
								border-gray-400 py-1 focus:outline-none focus:border-blue-300"
								style="width: 50px"> </small> --}}
                            <span class="text-muted">Cant: {{ $cartItem->qty}}</span>  
                            
                             <!-- Remove item from cart-->
                            <small>
                                <a href="#" class="px-2" style="text-decoration: none"
                                onclick="document.getElementById('delete-item-cart').submit()" >
                                Eliminar </a>
                            </small>
                            <form id="delete-item-cart" class="d-none" method="POST" action="{{ route('shop.cart.destroy', $cartItem->rowId) }}">
                                @csrf @method('DELETE')
                            </form>
                        </div>
                        <span class="text-muted">${{ $cartItem->price}}</span>   
                    </li>
                    @endforeach
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Total (USD)</span>
                        <strong>${{ \Gloudemans\Shoppingcart\Facades\Cart::priceTotal() }}</strong>
                    </li>
                </ul>
                <!-- END Products in cart resume -->
            </div>
            <!-- Buyer billing payment data  -->
            <div class="col-md-7 col-lg-8">
                <h4 class="mb-3">Billing address</h4>
                <form class="needs-validation" action="{{route('payment.create.session')}}" method="post" novalidate>
                    @csrf
                    <div class="row g-3">

                        <div class="col-sm-6">
                            <label for="firstName" class="form-label">First name</label>
                            <input type="text" class="form-control" id="firstName" 
                                name="buyer['name']" placeholder="Your name" value="{{ auth()->user()->name}}" required>
                            <div class="invalid-feedback">
                                Valid first name is required.
                            </div>
                        </div>
                    
                        <div class="col-sm-6">
                            <label for="lastName" class="form-label">Last name</label>
                            <input type="text" class="form-control" id="lastName" 
                                name="buyer['surname']" placeholder="Your Last name" value="" required>
                            <div class="invalid-feedback">
                                Valid last name is required.
                            </div>
                        </div>
                        
                        <div class="col-12">
                            <label for="email" class="form-label">Email <span class="text-muted">(Optional)</span></label>
                            <input type="email" class="form-control" id="email" 
                                name="buyer['email']" placeholder="you@example.com"  value="{{ auth()->user()->email}}">
                            <div class="invalid-feedback">
                                Please enter a valid email address for shipping updates.
                            </div>
                        </div>
                        
                        <div class="col-12">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" id="address" 
                                name="buyer['address']['street']" placeholder="1234 Main St" required>
                            <div class="invalid-feedback">
                                Please enter your shipping address.
                            </div>
                        </div>
                    
                        <div class="col-md-5">
                            <label for="country" class="form-label">Country</label>
                            <select class="form-select" id="country" name="buyer['address']['country']" required>
                                <option value="CO" selected>Colombia</option>
                            </select>
                            <div class="invalid-feedback">
                                Please select a valid country.
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <label for="state" class="form-label">State</label>
                            <select class="form-select" id="state" name="buyer['address']['state']" required>
                                <option value="Norte de Santander" selected>Norte de Santander</option>
                                <option value="Santander">Santander</option>
                                <option value="Antioquia">Antioquia</option>
                            </select>
                            <div class="invalid-feedback">
                                Please provide a valid state.
                            </div>
                        </div>
                        
                        <div class="col-md-3">
                            <label for="zip" class="form-label">Zip</label>
                            <input type="text" class="form-control" id="zip" name="buyer['address']['postalCode']" placeholder="">
                            <div class="invalid-feedback">
                                Zip code required.
                            </div>
                        </div>
                    </div>
                    
                    <hr class="my-4">
                    
                    
                    
                    <button class="w-100 btn btn-primary btn-lg" type="submit">Continue to checkout</button>
                </form>
            </div>
        </div>
    </main>
</div>

@endsection
