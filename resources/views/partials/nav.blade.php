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
			aria-label="{{ trans('Toggle navigation') }}">
			<span class="navbar-toggler-icon"></span>
		</button>
	
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
		<ul class="nav me-auto">
			@auth
			<li class="nav-item {{ setActive('products.*') }}">
				<a class="nav-link" href="{{ url('/landing') }}">{{ trans('Products') }}</a>
			</li>
			<li class="nav-item {{ setActive('contact')  }}">
				<a class="nav-link" href="{{ route('contact') }}">{{ trans('titles.Contact') }}</a>
			</li>
			@endauth
		</ul>
		<ul class="nav ms-auto">
			<cart-button :content='@json(Cart::content()->values())' :cart-count='{{ Cart::count() }}'></cart-button>

			@can('is-admin')
			<div class="dropdown">
				<a class="nav-link dropdown-toggle" 
				id="navbarDropdown"
				role="button" 
				data-bs-toggle="dropdown" 
				aria-expanded="false">
				{{ trans('form.button.management') }}
				</a>
				<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
					<li>
						<a class="nav-link dropdown-item" href="{{ route('admin.users.index') }}">{{ trans('titles.Admin') }}</a>
					</li>
					<li>
						<a class="nav-link dropdown-item" href="{{ route('admin.products.index') }}">{{ trans('titles.admin_products') }}</a>
					</li>
					<li>
						<a class="nav-link dropdown-item" href="{{ url('/admin/exports') }}">{{ trans('form.products.export_products') }}</a>
					</li>
					<li>
						<a class="nav-link dropdown-item" href="{{ url('/admin/imports') }}">{{ trans('form.products.import_products') }}</a>
					</li>
					<li >
						<a class="nav-link dropdown-item" href="{{ url('') }}">{{ trans('form.products.reports') }}</a>
					</li>	
				</ul>
			</div>
			@endcan

			@auth
			<div class="dropdown">
				<a class="nav-link dropdown-toggle" 
				id="navbarDropdown"
				role="button" 
				data-bs-toggle="dropdown" 
				aria-expanded="false">
				{{ trans('form.users.hi')}}, {{ auth()->user()->name }}!
				</a>
			
				<ul class="dropdown-menu" aria-labelledby="navbarDropdown">
					<form class="dropdown-item" action="{{ route('logout') }}" method="POST">
						@csrf
						<button class="border-0 bg-white">{{ trans('form.button.logout')}}</button>
					</form> 
					<li>
						<a class="nav-link dropdown-item" href="{{ route('customer.profile.index') }}"> {{ trans('form.button.purchases') }} </a>
					</li>
				</ul>
			</div>

			@else
			<li class="nav-item">
				<a class="nav-link" href="{{ route('login') }}">{{ trans('form.button.login') }}</a>
			</li>
            
            @if (Route::has('register'))
			<li class="nav-item">
            	<a class="nav-link" href="{{ route('register') }}" >{{ trans('form.button.register') }}</a>
			</li>
            @endif
            
            @if (Route::has('password.request'))
			<li class="nav-item">
            	<a class="nav-link" href="{{ route('password.request') }}">{{ trans('messages.form.forgot_pass') }}</a>
			</li>
            @endif
			@endauth

		</ul>
	</div>
</div>
	
</nav>