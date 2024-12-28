
<script src="{{ asset('theme/admin/assets/js/bootstrap.bundle.min.js') }}"></script>
<script>
    const PATH_ROOT = '{{ config('app.url') }}'
</script>

<!--plugins-->
<script src="{{ asset('theme/admin/assets/js/jquery.min.js') }}"></script>
<!--plugins-->

<script src="{{asset('theme/admin/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js')}}"></script>
<script src="{{asset('theme/admin/assets/plugins/metismenu/metisMenu.min.js')}}"></script>
<script>
    function timeAgo(dateString) {
                const now = new Date();
                const past = new Date(dateString);
                const diffInSeconds = Math.floor((now - past) / 1000);

                      if (diffInSeconds < 60) {
                          return `${diffInSeconds} giây trước`;
                      } else if (diffInSeconds < 3600) {
                          const minutes = Math.floor(diffInSeconds / 60);
                          return `${minutes} phút trước`;
                      } else if (diffInSeconds < 86400) {
                          const hours = Math.floor(diffInSeconds / 3600);
                          return `${hours} giờ trước`;
                      } else {
                          const days = Math.floor(diffInSeconds / 86400);
                          return `${days} ngày trước`;
    }


}
    function updateNotificationTimes() {
        document.querySelectorAll('.notify-time').forEach(element => {
            const timeString = element.dataset.time;
            element.textContent = timeAgo(timeString);
        });
    }
</script>

<script src="{{ asset('theme/admin/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
<script src="{{ asset('theme/admin/assets/plugins/metismenu/metisMenu.min.js') }}"></script>

@yield('js_new')

<script src="{{ asset('theme/admin/assets/plugins/simplebar/js/simplebar.min.js') }}"></script>
<script src="{{ asset('theme/admin/assets/js/main.js') }}"></script>

