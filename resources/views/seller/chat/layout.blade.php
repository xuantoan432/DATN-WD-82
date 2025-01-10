@extends('seller.layouts.master')
@section('content')
    <div class="main-content">

        <div class="chat-wrapper">
            @include('seller.chat.sidebar')

            @yield('content-chat')

            <!--start chat overlay-->
            <div class="overlay chat-toggle-btn-mobile"></div>
            <!--end chat overlay-->
        </div>

    </div>
@endsection
@section('css_new')
    <link rel="stylesheet" href="{{ asset('theme/admin/assets/css/extra-icons.css') }}">
@endsection
@section('js_new')
    <script>
        new PerfectScrollbar('.chat-list');
        new PerfectScrollbar('.chat-content');
    </script>
    @yield('js-chat')
@endsection
