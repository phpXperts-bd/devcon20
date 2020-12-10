<!DOCTYPE html>
<html class="">
<head>

    @include('devcon20.partials.header')
</head>
<body>
    @yield('main-content')

    @include('devcon20.partials.footer-js')
    @include('sweetalert::alert')
</body>
</html>
