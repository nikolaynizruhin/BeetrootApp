<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="robots" content="noindex">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Beetroot Family Portal</title>

    <!-- Scripts -->
    @stack('scripts')
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/ico" href="{{ asset('favicon.ico') }}"/>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        @include('layouts.partials.nav')

        <main class="py-4">
            @yield('content')
        </main>

        @include('layouts.partials.footer')
    </div>
</body>
</html>
