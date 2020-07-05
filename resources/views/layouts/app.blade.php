<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app" class="container is-fluid">
        @include('includes.header')
            <main class="mt-20 columns is-ancestor is-offset-6">
                @include('includes.left-sidebar')
                @yield('content')
                @include('includes.right-sidebar')
            </main>
        @include('includes.footer')
    </div>
</body>
</html>
