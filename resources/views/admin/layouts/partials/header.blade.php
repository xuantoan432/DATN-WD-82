<nav class="navbar navbar-expand align-items-center gap-4">
    <div class="btn-toggle">
        <a href="javascript:;"><i class="material-icons-outlined">menu</i></a>
    </div>
    <div id="confirmationModal" style="display: none; position: fixed; top: 30%; left: 40%; padding: 20px; background: white; border: 1px solid black;">
        <p>Bạn đã được xác thực thành công. Bạn có muốn chuyển hướng tới trang đăng nhập không?</p>
        <button onclick="confirmRedirect()">OK</button>
        <button onclick="closeModal()">Cancel</button>
    </div>

    <script>
        function showModal() {
            document.getElementById('confirmationModal').style.display = 'block';
        }

        function closeModal() {
            document.getElementById('confirmationModal').style.display = 'none';
        }

        function confirmRedirect() {
            window.location.href = "/"; // Redirect to login or homepage
        }

        // Replace window.confirm with custom modal when notification arrives
        window.Echo.private(`user.${window.userId}`)
            .listen('SellerApproved', (e) => {
                if (e.userId === window.userId) {
                    showModal(); // Show custom modal instead of window.confirm
                }
            });
    </script>
    <div class="search-bar flex-grow-1">

    </div>
    <ul class="navbar-nav gap-1 nav-right-links align-items-center">
        {{--        thông báo --}}
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" data-bs-auto-close="outside"
                data-bs-toggle="dropdown" href="javascript:;"><i class="material-icons-outlined">notifications</i>
                <span class="badge-notify" data-data="{{ count($notifications) }}" id="notif-cont">
                    @if (count($notifications) > 9)
                        {{ count($notifications) }}
                    @else
                        {{ count($notifications) > 0 ? '0' . count($notifications) : 0 }}
                    @endif
                </span>
            </a>
            <div class="dropdown-menu dropdown-notify dropdown-menu-end shadow">
                <div class="px-3 py-1 d-flex align-items-center justify-content-between border-bottom">
                    <h5 class="notiy-title mb-0">Thông báo </h5>

                </div>
                <div class="notify-list">
                    @foreach ($notification as $item)
                    @if ($item->notifiable_type == 'App\Models\Product')

                    <div>
                        <a class="dropdown-item border-bottom py-2 position-relative" href="{{route('admin.phe-duyet.show' ,$item->notifiable_id )}}">
                            <div class="d-flex align-items-center gap-3">
                                <div class="">
                                    <img src="{{ asset('theme/admin/assets/images/avatars/01.png') }}"
                                        class="rounded-circle" width="45" height="45" alt="">
                                </div>
                                <div class="">
                                    <h5 class="notify-title">
                                        <h5 class="notify-title">
                                            {{ $item->notifiable->seller->store_name  }} Đã {{  $item-> title }}
                                        </h5>

                                    </h5>
                                    <p class="mb-0 notify-desc">{{ $item -> message }}</p>
                                    <p class="mb-0 notify-time" data-time="{{ $item->created_at }}"></p>
                                </div>
                                <div class="notify-close position-absolute end-0 me-3">
                                    <i class="material-icons-outlined fs-6">close</i>
                                </div>
                            </div>
                        @if ($item->status == 'pending')
                        <span class="badge-notify" ></span>
                        @endif

                        </a>
                    </div>
                    @else
                    <div>
                        <a class="dropdown-item border-bottom py-2 position-relative" href="{{url('123')}}">
                            <div class="d-flex align-items-center gap-3">
                                <div class="">
                                    <img src="{{ asset('theme/admin/assets/images/avatars/01.png') }}"
                                        class="rounded-circle" width="45" height="45" alt="">
                                </div>
                                <div class="">
                                    <h5 class="notify-title">
                                        <h5 class="notify-title">
                                            {{ $item->notifiable->name  }} Đã {{  $item-> title }}
                                        </h5>

                                    </h5>
                                    <p class="mb-0 notify-desc">{{ $item -> message }}</p>
                                    <p class="mb-0 notify-time" data-time="{{ $item->created_at }}"></p>
                                </div>
                                <div class="notify-close position-absolute end-0 me-3">
                                    <i class="material-icons-outlined fs-6">close</i>
                                </div>
                            </div>
                        @if ($item->status == 'pending')
                        <span class="badge-notify" ></span>
                        @endif

                        </a>
                    </div>
                    @endif

                    @endforeach
                </div>
            </div>
        </li>
        {{-- kết thúc thông  báo --}}
        <li class="nav-item dropdown">
            <a href="javascrpt:;" class="dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown">
                <img src="{{ \Illuminate\Support\Facades\Storage::url(\Illuminate\Support\Facades\Auth::user()->avatar) }}"
                    class="rounded-circle p-1 border" width="45" height="45"
                    alt="{{ \Illuminate\Support\Facades\Auth::user()->name }}">
            </a>
            <div class="dropdown-menu dropdown-user dropdown-menu-end shadow">
                <a class="dropdown-item  gap-2 py-2" href="javascript:;">
                    <div class="text-center">
                        <img src="{{ \Illuminate\Support\Facades\Storage::url(\Illuminate\Support\Facades\Auth::user()->avatar) }}"
                            class="rounded-circle p-1 shadow mb-3" width="90" style="border-radius: 50%;" height="90"
                            alt="{{ \Illuminate\Support\Facades\Auth::user()->name }}">
                        <h5 class="user-name mb-0 fw-bold">{{ \Illuminate\Support\Facades\Auth::user()->name }}</h5>
                    </div>
                </a>
                <hr class="dropdown-divider">
                <a class="dropdown-item d-flex align-items-center gap-2 py-2" href="javascript:;"><i
                        class="material-icons-outlined">person_outline</i>Hồ sơ</a>
                <a class="dropdown-item d-flex align-items-center gap-2 py-2" href="javascript:;"><i
                        class="material-icons-outlined">local_bar</i>Cài đặt</a>
                <a class="dropdown-item d-flex align-items-center gap-2 py-2" href="{{route('home.index')}}"><i
                        class="material-icons-outlined">dashboard</i>Truy cập Website</a>
                <hr class="dropdown-divider">
                <a class="dropdown-item d-flex align-items-center gap-2 py-2" href="{{route('logout')}}"><i
                        class="material-icons-outlined">power_settings_new</i>Logout</a>
            </div>
        </li>
    </ul>

</nav>
