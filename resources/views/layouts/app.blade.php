<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/js/app.js'])
    
    <title>{{ config('app.name', 'Laravel') }}</title>
</head>

<body style="padding: 0;margin:0px;">
    <div id="app">
        @yield('content')
    </div>
</body>

</html>
