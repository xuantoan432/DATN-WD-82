<!doctype html>
<html lang="en" data-bs-theme="blue-theme">



<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>StyleNest</title>
    @include('admin.layouts.partials.head')

</head>

<body>

    <!--start header-->
    <header class="top-header">
        @include('admin.layouts.partials.header')
    </header>
    <!--end top header-->


    <!--start sidebar-->
    <aside class="sidebar-wrapper" data-simplebar="true">
        @include('admin.layouts.partials.sidebar')

    </aside>
    <!--end sidebar-->

    <!--start main wrapper-->
    <main class="main-wrapper">
        @yield('content')
    </main>
    <!--end main wrapper-->

    <!--start overlay-->
    <div class="overlay btn-toggle"></div>
    <!--end overlay-->

    <!--start footer-->
    <footer class="page-footer">
        @include('admin.layouts.partials.footer')

    </footer>
    <!--end footer-->

    <!--start cart-->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasCart">
        @include('admin.layouts.partials.canvasCart')

    </div>
    <!--end cart-->



    <!--start switcher-->
    <button class="btn btn-grd btn-grd-primary position-fixed bottom-0 end-0 m-3 d-flex align-items-center gap-2"
        type="button" data-bs-toggle="offcanvas" data-bs-target="#staticBackdrop">
        <i class="material-icons-outlined">tune</i>Customize
    </button>

    <div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="staticBackdrop">
        @include('admin.layouts.partials.canvas-setting')

    </div>
    <!--start switcher-->

    <!--bootstrap js-->
    @include('admin.layouts.partials.script')

    @vite('resources/js/admin/notification.js')

</body>


<!-- Mirrored from codervent.com/maxton/demo/vertical-menu/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 31 Jul 2024 20:34:21 GMT -->

</html>
