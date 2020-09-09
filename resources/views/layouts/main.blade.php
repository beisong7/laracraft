<?php $ver = 0.12 ?>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> {{ !empty($title)?$title:'Home' }} | {{ env('APP_NAME', '') }}   </title>
    <link rel="icon" type="image/png" href="{{ url('img/logo.png') }}">

    @include('layouts.scripts.css')

    <!-- Scripts -->

</head>
<body class="js">

    {{--@include('layouts.preload')--}}

    @yield('content')

    @include('layouts.footer')

    @include('layouts.scripts.js')
</body>
</html>
