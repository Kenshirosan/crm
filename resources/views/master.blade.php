<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>

        <link rel="stylesheet"
              href="{{  mix( '/css/app.css') }}">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
        <!-- Styles -->

    </head>
    <body>
    <main class="content" id="app">
        @include('includes.header')

        <div class="container-fluid">
            <div class="col-md-12">
                <router-view></router-view>
                <flash></flash>
            </div>
        </div>

        @include('includes.footer')
    </main>
        <script src="{{ mix('/js/app.js') }}"></script>
    </body>
</html>
