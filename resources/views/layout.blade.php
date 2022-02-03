<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	<title>@yield('title', 'MERCATODO')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/css/app.css">
    <script src="/js/app.js" defer> </script>
    <style>
        #login-status {
            float:right;
        }
    </style>
</head>
<body>
    @include('partials.nav')
    <div class="d-flex flex-column justify-content-between h-screen">
        @include('partials.session-status')
        <main>
            @yield('content')
        </main>

        <footer class="bg-white text-center text-black-50 py-3 shadow">
            {{config('app.name')}} | {{date('Y')}}
        </footer>
    </div>

</body>
</html>