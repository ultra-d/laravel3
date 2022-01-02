<nav>
	<ul>
		<li class="{{ setActive('home') }}"><a href="{{ route('home') }}">@lang('Home')</a></li>
		<li class="{{ setActive('about') }}"><a href="{{ route('about') }}">@lang('About')</a></li>
		<li class="{{ setActive('products.*') }}"><a href="{{ route('products.index') }}">@lang('Products')</a></li>
		<li class="{{ setActive('contact')  }}"><a href="{{ route('contact') }}">@lang('Contact')</a></li>
		@can('is-admin')
            <li class="{{ setActive('admin.users.index') }}"><a href="{{ route('admin.users.index') }}">User management</a></li>
        @endcan
	</ul>
</nav>