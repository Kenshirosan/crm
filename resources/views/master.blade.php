<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>

        <link rel="stylesheet"
              href="{{  mix( '/css/app.css') }}">
        <!-- Styles -->

    </head>
    <body>
    <main class="content container is-fluid" id="app">
        @include('includes.header')

        <div class="columns is-ancestor">
            @include('includes.left-sidebar')
            <div class="column is-parent is-4 is-offset-1">
                <router-view></router-view>
            </div>
            @include('includes.right-sidebar')
        </div>
        @include('includes.footer')
    </main>
        <script src="{{ mix('/js/app.js') }}"></script>
    </body>
</html>
