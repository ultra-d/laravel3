<link rel="stylesheet" 
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<nav class="navbar navbar-light navbar-expand-lg bg-white shadow-sm">
	<div class="container">
		<a class="navbar-brand nav-link" 
			href="{{ route('home')}}">
			{{ config('app.name') }}
		</a>
		<button class="navbar-toggler" type="button" 
			data-bs-toggle="collapse" 
			data-bs-target="#navbarSupportedContent" 
			aria-controls="navbarSupportedContent" 
			aria-expanded="false" 
			aria-label="{{ __('Toggle navigation') }}">
			<span class="navbar-toggler-icon"></span>
		</button>
	
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
		<ul class="nav me-auto">
			@auth
			<li class="nav-item {{ setActive('products.*') }}">
				<a class="nav-link" href="{{ url('/landing') }}">{{ __('Products') }}</a>
			</li>
			@can('is-admin')
			<li class="nav-item {{ setActive('products.*') }}">
				<a class="nav-link" href="{{ route('admin.products.index') }}">{{ __('titles.admin_products') }}</a>
			</li>
			@endcan
			<li class="nav-item {{ setActive('contact')  }}">
				<a class="nav-link" href="{{ route('contact') }}">{{ __('titles.Contact') }}</a>
			</li>
			@endauth
		</ul>
		<ul class="nav ms-auto">
			<cart-button :content='@json(Cart::content()->values())' :cart-count='{{ Cart::count() }}'></cart-button>

			@can('is-admin')
			<li class="nav-item float-right{{ setActive('admin.users.index') }}">
				<a class="nav-link" href="{{ route('admin.users.index') }}">{{ __('titles.Admin') }}</a>
			</li>
			@endcan

			@auth
			<div class="dropdown">
				<a class="nav-link dropdown-toggle" 
				id="navbarDropdown"
				role="button" 
				data-bs-toggle="dropdown" 
				aria-expanded="false">
				{{__('form.users.hi')}}, {{ auth()->user()->name }}!
				</a>
			
				<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
					<form class="dropdown-item" action="{{ route('logout') }}" method="POST">
						@csrf
						<button class="border-0 bg-white">{{__('form.button.logout')}}</button>
					</form> 
					
					<li><a class="dropdown-item" href="{{ route('customer.profile.index') }}">Perfil</a></li>
				</ul>
			</div>

			@else
			<li class="nav-item">
				<a class="nav-link" href="{{ route('login') }}">{{ __('form.button.login') }}</a>
			</li>
            
            
            @if (Route::has('register'))
			<li class="nav-item">
            	<a class="nav-link" href="{{ route('register') }}" >{{ __('form.button.register') }}</a>
			</li>
            @endif
            
            @if (Route::has('password.request'))
			<li class="nav-item">
            	<a class="nav-link" href="{{ route('password.request') }}">{{ __('messages.form.forgot_pass') }}</a>
			</li>
            @endif
			@endauth

		</ul>
	</div>
</div>
	
</nav>