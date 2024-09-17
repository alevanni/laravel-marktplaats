<!DOCTYPE html>
<html>
<head>
    <title>App Name - @yield('title')</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    @include('partials.nav')
    @yield('content')
</body>
</html>