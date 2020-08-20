<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
</head>
<body>
    <nav class="navbar">
        <img src="{{ url("images/logo_navbar.jpg") }}" />
    </nav>

    @yield('content')
</body>
<style type="text/css">
    nav.navbar {
        background-color: #4F62C0;
    }
</style>
</html>
