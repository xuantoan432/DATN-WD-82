<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="keywords"
        content="ShopUS, bootstrap-5, bootstrap, sass, css, HTML Template, HTML,html, bootstrap template, free template, figma, web design, web development,front end, bootstrap datepicker, bootstrap timepicker, javascript, ecommerce template">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="/themes/client/assets/images/homepage-one/icon.png">

    <title>@yield('title')</title>

    @include('client.layouts.patials.css')
    @yield('css')

</head>

<body>

    @include('client.layouts.patials.header')

    @yield('banner')


    @yield('content')


    @yield('best-sell')


    @yield('flash-sale')



    @include('client.layouts.patials.footer')

</body>

@include('client.layouts.patials.js')
@yield('js')

</html>
