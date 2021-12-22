<!DOCTYPE html>
<html>

<head>
	<title>@yield('title', 'This is MERCATODO')</title>
	<style>
		.active a {
			color: red;
			text-decoration: none
		}
        #login-status {
            float:right;
        }​
	</style>
</head>
<body>
	@include('partials.nav')
	@if (Route::has('login'))
        <div id="login-status" class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0 float:right">
            <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                @auth
                    Hola, {{ auth()->user()->name }}!
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button>LogOut</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                    @endif

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}">Forgot Password?</a>
                    @endif
                @endauth
            </div>
        </div>
    @endif
	@include('partials.session-status')
	@yield('content')
</body>
</html>