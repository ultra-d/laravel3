<nav class="navbar navbar-light navbar-expand-lg bg-white shadow-sm">
	<div class="container">
		<a class="navbar-bar nav-link" href="{{ route('home')}}">
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
		<ul class="nav nav-pills">
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
			@can('is-admin')
			<li class="{{ setActive('admin.users.index') }}"><a href="{{ route('admin.users.index') }}">{{ __('titles.Admin') }}</a></li>
			@endcan
		</ul>
	</div>
</div>
	
</nav>