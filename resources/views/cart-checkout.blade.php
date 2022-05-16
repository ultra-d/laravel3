@extends('layout')

@section('title', trans('titles.cart'))

@section('content')

<div class="container mb-4">
    <main>
        <div class="py-5 text-center">
            <h1>{{trans('titles.checkout_form')}}</h1>
        </div>
        
        <div class="row g-5">
            <div class="col-md-5 col-lg-4 order-md-last">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-primary">{{trans('titles.cart')}}</span>
                    <span class="badge bg-primary rounded-pill">{{ \Gloudemans\Shoppingcart\Facades\Cart::content()->count() }}</span>
                </h4>
                 <!-- Products in cart resume -->
                <ul class="list-group mb-3">
                    @foreach($cart as $cartItem)
                    <li class="list-group-item d-flex justify-content-between lh-sm">
                        <div>
                            <h6 class="my-0">{{ $cartItem->name}}</h6>
                            <hr class="my-1">
                           
                            <span class="text-muted">{{trans('form.products.short_qty')}}: {{ $cartItem->qty}}</span> 
                            
                             <!-- Remove item from cart-->
                            <small>
                                <a href="#" class="px-2" style="text-decoration: none"
                                onclick="document.getElementById('delete-item-cart').submit()" >
                                {{trans('form.button.delete')}} </a>
                            </small>
                            <form id="delete-item-cart" class="d-none" method="POST" action="{{ route('shop.cart.destroy', $cartItem->rowId) }}">
                                @csrf @method('DELETE')
                            </form>
                        </div>
                        <span class="text-muted">${{ $cartItem->price}}</span>   
                    </li>
                    @endforeach
                    <li class="list-group-item d-flex justify-content-between">
                        <span>{{trans('form.invoice.total')}} (COP)</span>
                        <strong>${{ \Gloudemans\Shoppingcart\Facades\Cart::priceTotal() }}</strong>
                    </li>
                </ul>
            </div>
    
            <div class="col-md-7 col-lg-8">
                <h4 class="mb-3">{{trans('form.billing.billing_info')}}</h4>
                <form class="needs-validation" action="{{route('shop.cart.checkout')}}" method="post" novalidate>
                    @csrf
                    <div class="row g-3">

                        <div class="col-sm-6">
                            <label for="firstName" class="form-label">{{trans('form.users.name')}}</label>
                            <input type="text" 
                                class="form-control
                                @error('firstName') is-invalid @else border-1 @enderror" 
                                id="firstName" 
                                name="buyer['name']" 
                                placeholder="Your name" 
                                value="{{ auth()->user()->name}}" required>
                                @error('firstName')
                                    <span class="invalid-feedback" role="alert">
                                        <strong> {{$message}} </strong>
                                    </span>
                                @enderror
                        </div>
                    
                        <div class="col-sm-6">
                            <label for="lastName" class="form-label">{{trans('form.users.surname')}}</label>
                            <input type="text" 
                                class="form-control
                                @error('lastName') is-invalid @else border-1 @enderror" 
                                id="lastName" 
                                name="buyer['surname']" 
                                placeholder="Your Last name" value="" required>
                                @error('lastName')
                                    <span class="invalid-feedback" role="alert">
                                        <strong> {{$message}} </strong>
                                    </span>
                                @enderror
                        </div>
                        
                        <div class="col-12">
                            <label for="email" class="form-label">{{trans('form.users.email')}}<span class="text-muted">(Optional)</span></label>
                            <input type="email"
                                class="form-control
                                @error('email') is-invalid @else border-1 @enderror" 
                                id="email" 
                                name="buyer['email']" placeholder="you@example.com"  value="{{ auth()->user()->email}}">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong> {{$message}} </strong>
                                    </span>
                                @enderror
                        </div>
                        
                        <div class="col-12">
                            <label for="address" class="form-label">{{trans('form.billing.address')}}</label>
                            <input type="text" 
                                class="form-control
                                @error('address') is-invalid @else border-1 @enderror"
                                id="address" 
                                name="buyer['address']['street']" placeholder="1234 Main St" required>
                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong> {{$message}} </strong>
                                    </span>
                                @enderror
                        </div>
                    
                        <div class="col-md-5">
                            <label for="country" class="form-label">{{trans('form.billing.country')}}</label>
                            <select class="form-select" id="country" name="buyer['address']['country']" required>
                                <option value="CO" selected>Colombia</option>
                            </select>
                        </div>
                        
                        <div class="col-md-4">
                            <label for="state" class="form-label">{{trans('form.billing.state')}}</label>
                            <select class="form-select" id="state" name="buyer['address']['state']" required>
                                <option value="Norte de Santander" selected>Norte de Santander</option>
                                <option value="Santander">Santander</option>
                                <option value="Antioquia">Antioquia</option>
                            </select>
                        </div>
                        
                        <div class="col-md-3">
                            <label for="zip" class="form-label">{{trans('form.billing.postal_code')}}</label>
                            <input type="text"
                                class="form-control
                                @error('zip') is-invalid @else border-1 @enderror" 
                                id="zip" name="buyer['address']['postalCode']" placeholder="12345" required>
                                @error('zip')
                                    <span class="invalid-feedback" role="alert">
                                        <strong> {{$message}} </strong>
                                    </span>
                                @enderror
                        </div>
                    </div>
                    
                    <hr class="my-4">
                    
                    <button class="w-100 btn btn-primary btn-lg" type="submit">{{trans('form.button.continue')}}</button>
                </form>
            </div>
        </div>
    </main>
</div>

@endsection
