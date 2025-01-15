<script>
    let sellerId = {{ auth()->user()->seller?->id }}
    const PATH_ROOT = '{{ config('app.url') }}'


</script>
@vite('resources/js/seller/notification.js')
<script src="{{asset('theme/admin/assets/js/bootstrap.bundle.min.js')}}"></script>

<!--plugins-->
<script src="{{asset('theme/admin/assets/js/jquery.min.js')}}"></script>
<!--plugins-->
<script src="{{asset('theme/admin/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js')}}"></script>
<script src="{{asset('theme/admin/assets/plugins/metismenu/metisMenu.min.js')}}"></script>
@yield('js_new')
<script src="{{asset('theme/admin/assets/plugins/simplebar/js/simplebar.min.js')}}"></script>
<script src="{{asset('theme/admin/assets/js/main.js')}}"></script>
