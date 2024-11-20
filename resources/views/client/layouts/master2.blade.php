<!doctype html>
<html lang="en">

<!-- Mirrored from quomodothemes.website/html/shopus/product-sidebar.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 05 Oct 2024 15:18:43 GMT -->

<head>
    <meta charset="utf-8">
    <meta name="keywords"
        content="ShopUS, bootstrap-5, bootstrap, sass, css, HTML Template, HTML,html, bootstrap template, free template, figma, web design, web development,front end, bootstrap datepicker, bootstrap timepicker, javascript, ecommerce template">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="assets/images/homepage-one/icon.png">
    <title>@yield('title')</title>

    @include('client.layouts.patials.css')



</head>

<body>

    @include('client.layouts.patials.header')

    @yield('info')

    <section class="product product-sidebar footer-padding">
        <div class="container">
            <div class="row g-5">
                @include('client.layouts.patials.sidebar')

                @yield('content')
            </div>
        </div>
    </section>

    @include('client.layouts.patials.footer')

   @include('client.layouts.patials.js')
</body>

<!-- Mirrored from quomodothemes.website/html/shopus/product-sidebar.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 05 Oct 2024 15:18:43 GMT -->
<script type="test/javascript">
    $('.category-filter').click(funtion(){
        var category = [],
    })
</script>
</html>
