<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'CJ INSPIRED ACADEMY') }}</title>

    <link rel="icon" href="demo_icon.gif" type="image/gif" sizes="16x16">

    @include('partials.login.inc_top')
    @stack('css')
</head>

<body>
{{-- @include('partials.login.header') --}}
@yield('content')
{{-- @include('partials.login.footer') --}}
@stack('js')
</body>

</html>
