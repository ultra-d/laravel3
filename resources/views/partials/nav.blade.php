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
			<li class="nav-item {{ setActive('home') }}">
				<a class="nav-link" href="{{ route('home') }}">{{ __('titles.HOME') }}</a>
			</li>
			<li class="nav-item {{ setActive('about') }} nav-item ">
				<a class="nav-link" href="{{ route('about') }}">{{ __('titles.About') }}</a>
			</li>
			<li class="nav-item {{ setActive('products.*') }}">
				<a class="nav-link" href="{{ route('products.index') }}">{{ __('titles.Products') }}</a>
			</li>
			<li class="nav-item {{ setActive('contact')  }}">
				<a class="nav-link" href="{{ route('contact') }}">{{ __('titles.Contact') }}</a>
			</li>
		</ul>
		<ul class="nav ms-auto">
			@can('is-admin')
			<li class="nav-item float-right{{ setActive('admin.users.index') }}">
				<a class="nav-link" href="{{ route('admin.users.index') }}">{{ __('titles.Admin') }}</a>
			</li>
			@endcan







			@auth
			<li class="nav-item dropdown">
				<a id="navbarDropdown" 
				class="nav-link dropdown-toggle" 
				href="#" role="button" 
				data-bs-toggle="dropdown" 
				aria-haspopup="true" 
				aria-expanded="false" v-pre>
				{{__('form.users.hi')}}, {{ auth()->user()->name }}!
				</a>

				<div class="dropdown-menu dropdown-menu-right" 
					aria-labelledby="navbarDropdown">
					<form class="dropdown-item" action="{{ route('logout') }}" method="POST">
						@csrf
						<button class="border-0 bg-white">{{__('form.button.logout')}}</button>
					</form>               
				</div>
			</li>
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