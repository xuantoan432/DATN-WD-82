@use('App\Models\Review')
<nav class="navbar navbar-expand align-items-center gap-4">
    <div class="btn-toggle">
        <a href="javascript:;"><i class="material-icons-outlined">menu</i></a>
    </div>
    <div class="search-bar flex-grow-1">
        <div class="position-relative">

        </div>
    </div>
    <ul class="navbar-nav gap-1 nav-right-links align-items-center">
        {{-- <li class="nav-item d-lg-none mobile-search-btn">
            <a class="nav-link" href="javascript:;"><i class="material-icons-outlined">search</i></a>
        </li> --}}
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="avascript:;"
                data-bs-toggle="dropdown"><img src="{{asset('theme/admin/assets/images/county/02.png')}}" width="22"
                    alt="">
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item d-flex align-items-center py-2" href="javascript:;"><img
                            src="{{asset('theme/admin/assets/images/county/01.png')}}"width="20" alt=""><span
                            class="ms-2">English</span></a>
                </li>
                <li><a class="dropdown-item d-flex align-items-center py-2" href="javascript:;"><img
                            src="{{asset('theme/admin/assets/images/county/02.png')}}" width="20" alt=""><span
                            class="ms-2">Catalan</span></a>
                </li>
                <li><a class="dropdown-item d-flex align-items-center py-2" href="javascript:;"><img
                            src="{{asset('theme/admin/assets/images/county/03.png')}}" width="20" alt=""><span
                            class="ms-2">French</span></a>
                </li>
                <li><a class="dropdown-item d-flex align-items-center py-2" href="javascript:;"><img
                            src="{{asset('theme/admin/assets/images/county/04.png')}}" width="20" alt=""><span
                            class="ms-2">Belize</span></a>
                </li>
                <li><a class="dropdown-item d-flex align-items-center py-2" href="javascript:;"><img
                            src="{{asset('theme/admin/assets/images/county/05.png')}}" width="20" alt=""><span
                            class="ms-2">Colombia</span></a>
                </li>
                <li><a class="dropdown-item d-flex align-items-center py-2" href="javascript:;"><img
                            src="{{asset('theme/admin/assets/images/county/06.png')}}" width="20" alt=""><span
                            class="ms-2">Spanish</span></a>
                </li>
                <li><a class="dropdown-item d-flex align-items-center py-2" href="javascript:;"><img
                            src="{{asset('theme/admin/assets/images/county/07.png')}}" width="20" alt=""><span
                            class="ms-2">Georgian</span></a>
                </li>
                <li><a class="dropdown-item d-flex align-items-center py-2" href="javascript:;"><img
                            src="{{asset('theme/admin/assets/images/county/08.png')}}" width="20" alt=""><span
                            class="ms-2">Hindi</span></a>
                </li>
            </ul>
        </li>

        <li class="nav-item dropdown position-static d-md-flex d-none">
            <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" data-bs-auto-close="outside"
                data-bs-toggle="dropdown" href="javascript:;"><i
                    class="material-icons-outlined">done_all</i></a>
            <div class="dropdown-menu dropdown-menu-end mega-menu shadow-lg p-4 p-lg-5">
                <div class="mega-menu-widgets">
                    <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3 g-4 g-lg-5">
                        <div class="col">
                            <div class="card rounded-4 shadow-none border mb-0">
                                <div class="card-body">
                                    <div class="d-flex align-items-start gap-3">
                                        <div class="mega-menu-icon flex-shrink-0 bg-danger">
                                            <i class="material-icons-outlined">question_answer</i>
                                        </div>
                                        <div class="mega-menu-content">
                                            <h5>Marketing</h5>
                                            <p class="mb-0 f-14">In publishing and graphic design, Lorem ipsum
                                                is a placeholder text commonly used to demonstrate
                                                the visual form of a document.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card rounded-4 shadow-none border mb-0">
                                <div class="card-body">
                                    <div class="d-flex align-items-start gap-3">
                                        <img src="{{asset('theme/admin/assets/images/megaIcons/02.png')}}" width="40"
                                            alt="">
                                        <div class="mega-menu-content">
                                            <h5>Website</h5>
                                            <p class="mb-0 f-14">In publishing and graphic design, Lorem ipsum
                                                is a placeholder text commonly used to demonstrate
                                                the visual form of a document.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card rounded-4 shadow-none border mb-0">
                                <div class="card-body">
                                    <div class="d-flex align-items-start gap-3">
                                        <img src="{{asset('theme/admin/assets/images/megaIcons/03.png')}}" width="40"
                                            alt="">
                                        <div class="mega-menu-content">
                                            <h5>Subscribers</h5>
                                            <p class="mb-0 f-14">In publishing and graphic design, Lorem ipsum
                                                is a placeholder text commonly used to demonstrate
                                                the visual form of a document.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card rounded-4 shadow-none border mb-0">
                                <div class="card-body">
                                    <div class="d-flex align-items-start gap-3">
                                        <img src="{{asset('theme/admin/assets/images/megaIcons/01.png')}}" width="40"
                                            alt="">
                                        <div class="mega-menu-content">
                                            <h5>Hubspot</h5>
                                            <p class="mb-0 f-14">In publishing and graphic design, Lorem ipsum
                                                is a placeholder text commonly used to demonstrate
                                                the visual form of a document.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card rounded-4 shadow-none border mb-0">
                                <div class="card-body">
                                    <div class="d-flex align-items-start gap-3">
                                        <img src="{{asset('theme/admin/assets/images/megaIcons/11.png')}}" width="40"
                                            alt="">
                                        <div class="mega-menu-content">
                                            <h5>Templates</h5>
                                            <p class="mb-0 f-14">In publishing and graphic design, Lorem ipsum
                                                is a placeholder text commonly used to demonstrate
                                                the visual form of a document.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card rounded-4 shadow-none border mb-0">
                                <div class="card-body">
                                    <div class="d-flex align-items-start gap-3">
                                        <img src="{{asset('theme/admin/assets/images/megaIcons/13.png')}}" width="40"
                                            alt="">
                                        <div class="mega-menu-content">
                                            <h5>Ebooks</h5>
                                            <p class="mb-0 f-14">In publishing and graphic design, Lorem ipsum
                                                is a placeholder text commonly used to demonstrate
                                                the visual form of a document.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card rounded-4 shadow-none border mb-0">
                                <div class="card-body">
                                    <div class="d-flex align-items-start gap-3">
                                        <img src="{{asset('theme/admin/assets/images/megaIcons/12.png')}}" width="40"
                                            alt="">
                                        <div class="mega-menu-content">
                                            <h5>Sales</h5>
                                            <p class="mb-0 f-14">In publishing and graphic design, Lorem ipsum
                                                is a placeholder text commonly used to demonstrate
                                                the visual form of a document.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card rounded-4 shadow-none border mb-0">
                                <div class="card-body">
                                    <div class="d-flex align-items-start gap-3">
                                        <img src="{{asset('theme/admin/assets/images/megaIcons/08.png')}}" width="40"
                                            alt="">
                                        <div class="mega-menu-content">
                                            <h5>Tools</h5>
                                            <p class="mb-0 f-14">In publishing and graphic design, Lorem ipsum
                                                is a placeholder text commonly used to demonstrate
                                                the visual form of a document.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card rounded-4 shadow-none border mb-0">
                                <div class="card-body">
                                    <div class="d-flex align-items-start gap-3">
                                        <img src="{{asset('theme/admin/assets/images/megaIcons/09.png')}}" width="40"
                                            alt="">
                                        <div class="mega-menu-content">
                                            <h5>Academy</h5>
                                            <p class="mb-0 f-14">In publishing and graphic design, Lorem ipsum
                                                is a placeholder text commonly used to demonstrate
                                                the visual form of a document.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!--end row-->
                </div>
            </div>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" data-bs-auto-close="outside"
                data-bs-toggle="dropdown" href="javascript:;"><i class="material-icons-outlined">apps</i></a>
            <div class="dropdown-menu dropdown-menu-end dropdown-apps shadow-lg p-3">
                <div class="border rounded-4 overflow-hidden">
                    <div class="row row-cols-3 g-0 border-bottom">
                        <div class="col border-end">
                            <div class="app-wrapper d-flex flex-column gap-2 text-center">
                                <div class="app-icon">
                                    <img src="{{asset('theme/admin/assets/images/apps/01.png')}}" width="36" alt="">
                                </div>
                                <div class="app-name">
                                    <p class="mb-0">Gmail</p>
                                </div>
                            </div>
                        </div>
                        <div class="col border-end">
                            <div class="app-wrapper d-flex flex-column gap-2 text-center">
                                <div class="app-icon">
                                    <img src="{{asset('theme/admin/assets/images/apps/02.png')}}" width="36" alt="">
                                </div>
                                <div class="app-name">
                                    <p class="mb-0">Skype</p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="app-wrapper d-flex flex-column gap-2 text-center">
                                <div class="app-icon">
                                    <img src="{{asset('theme/admin/assets/images/apps/03.png" w')}}idth="36" alt="">
                                </div>
                                <div class="app-name">
                                    <p class="mb-0">Slack</p>
                                </div>
                            </div>
                        </div>
                    </div><!--end row-->

                    <div class="row row-cols-3 g-0 border-bottom">
                        <div class="col border-end">
                            <div class="app-wrapper d-flex flex-column gap-2 text-center">
                                <div class="app-icon">
                                    <img src="{{asset('theme/admin/assets/images/apps/04.png" w')}}idth="36" alt="">
                                </div>
                                <div class="app-name">
                                    <p class="mb-0">YouTube</p>
                                </div>
                            </div>
                        </div>
                        <div class="col border-end">
                            <div class="app-wrapper d-flex flex-column gap-2 text-center">
                                <div class="app-icon">
                                    <img src="{{asset('theme/admin/assets/images/apps/05.png" w')}}idth="36" alt="">
                                </div>
                                <div class="app-name">
                                    <p class="mb-0">Google</p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="app-wrapper d-flex flex-column gap-2 text-center">
                                <div class="app-icon">
                                    <img src="{{asset('theme/admin/assets/images/apps/06.png" w')}}idth="36" alt="">
                                </div>
                                <div class="app-name">
                                    <p class="mb-0">Instagram</p>
                                </div>
                            </div>
                        </div>
                    </div><!--end row-->

                    <div class="row row-cols-3 g-0 border-bottom">
                        <div class="col border-end">
                            <div class="app-wrapper d-flex flex-column gap-2 text-center">
                                <div class="app-icon">
                                    <img src="{{asset('theme/admin/assets/images/apps/07.png" w')}}idth="36" alt="">
                                </div>
                                <div class="app-name">
                                    <p class="mb-0">Spotify</p>
                                </div>
                            </div>
                        </div>
                        <div class="col border-end">
                            <div class="app-wrapper d-flex flex-column gap-2 text-center">
                                <div class="app-icon">
                                    <img src="{{asset('theme/admin/assets/images/apps/08.png" w')}}idth="36" alt="">
                                </div>
                                <div class="app-name">
                                    <p class="mb-0">Yahoo</p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="app-wrapper d-flex flex-column gap-2 text-center">
                                <div class="app-icon">
                                    <img src="{{asset('theme/admin/assets/images/apps/09.png" w')}}idth="36" alt="">
                                </div>
                                <div class="app-name">
                                    <p class="mb-0">Facebook</p>
                                </div>
                            </div>
                        </div>
                    </div><!--end row-->

                    <div class="row row-cols-3 g-0">
                        <div class="col border-end">
                            <div class="app-wrapper d-flex flex-column gap-2 text-center">
                                <div class="app-icon">
                                    <img src="{{asset('theme/admin/assets/images/apps/10.png')}}" width="36" alt="">
                                </div>
                                <div class="app-name">
                                    <p class="mb-0">Figma</p>
                                </div>
                            </div>
                        </div>
                        <div class="col border-end">
                            <div class="app-wrapper d-flex flex-column gap-2 text-center">
                                <div class="app-icon">
                                    <img src="{{asset('theme/admin/assets/images/apps/11.png')}}" width="36" alt="">
                                </div>
                                <div class="app-name">
                                    <p class="mb-0">Paypal</p>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="app-wrapper d-flex flex-column gap-2 text-center">
                                <div class="app-icon">
                                    <img src="{{asset('theme/admin/assets/images/apps/12.png')}}" width="36" alt="">
                                </div>
                                <div class="app-name">
                                    <p class="mb-0">Photo</p>
                                </div>
                            </div>
                        </div>
                    </div><!--end row-->
                </div>
            </div>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative"
                data-bs-auto-close="outside" data-bs-toggle="dropdown" href="javascript:;"><i
                    class="material-icons-outlined">notifications</i>
                <span class="badge-notify" id="notify-list-count">{{ $notifications->count() }}</span>
            </a>
            <div class="dropdown-menu dropdown-notify dropdown-menu-end shadow">
                <div class="px-3 py-1 d-flex align-items-center justify-content-between border-bottom">
                    <h5 class="notiy-title mb-0">Thông báo</h5>
                </div>
                <div class="notify-list" id="notify-list">
                    @foreach($notifications as $noti)
                        @if($noti->notifiable_type === Review::class)
                            <div>
                        <a class="dropdown-item border-bottom py-2" href="{{ route('seller.reviews.edit', $noti['notifiable']->id) }}">
                            <div class="d-flex align-items-center gap-3">
                                <div class="">
                                    <img src="{{ asset('theme/admin/assets/images/apps/review.png') }}" class="rounded-circle"
                                        width="45" height="45" alt="">
                                </div>
                                <div class="">
                                    <h5 class="notify-title">{{ $noti->title }}</h5>
                                    <p class="mb-0 notify-desc">{{ $noti->message }}</p>
                                    <p class="mb-0 notify-time">{{ $noti->created_at->diffForHumans() }}</p>
                                </div>
                                <div class="notify-close position-absolute end-0 me-3">
                                    <i class="material-icons-outlined fs-6">close</i>
                                </div>
                            </div>
                        </a>
                    </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </li>
        <li class="nav-item d-md-flex d-none">
            <a class="nav-link position-relative" data-bs-toggle="offcanvas" href="#offcanvasCart"><i
                    class="material-icons-outlined">shopping_cart</i>
                <span class="badge-notify" data-data="{{ count($notificationOrders) }}" id="notification-order-count">
                    @if (count($notificationOrders) > 9)
                        {{ count($notificationOrders) }}
                    @else
                        {{ count($notificationOrders) > 0 ? '0' . count($notificationOrders) : 0 }}
                    @endif
                </span>

            </a>
        </li>
        <li class="nav-item dropdown">
            <a href="javascrpt:;" class="dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown">
                <img src="{{ \Illuminate\Support\Facades\Storage::url(\Illuminate\Support\Facades\Auth::user()->avatar) }}" class="rounded-circle p-1 border" width="45"
                    height="45" alt="">
            </a>
            <div class="dropdown-menu dropdown-user dropdown-menu-end shadow">
                <a class="dropdown-item  gap-2 py-2" href="javascript:;">
                    <div class="text-center">
                        <img src="{{ \Illuminate\Support\Facades\Storage::url(\Illuminate\Support\Facades\Auth::user()->avatar) }}"
                        class="rounded-circle p-1 shadow mb-3" width="90" style="border-radius: 50%;" height="90"
                        alt="{{ \Illuminate\Support\Facades\Auth::user()->name }}">
                        <h5 class="user-name mb-0 fw-bold">Hello, {{ \Illuminate\Support\Facades\Auth::user()->name }}</h5>
                    </div>
                </a>
                <hr class="dropdown-divider">

                <a class="dropdown-item d-flex align-items-center gap-2 py-2" href="javascript:;"><i
                        class="material-icons-outlined">local_bar</i>Setting</a>

                <hr class="dropdown-divider">
                <a class="dropdown-item d-flex align-items-center gap-2 py-2" href="{{route('logout')}}"><i
                        class="material-icons-outlined">power_settings_new</i>Logout</a>
            </div>
        </li>
    </ul>

</nav>
<!--start cart-->
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasCart">
    @include('seller.layouts.partials.canvasCart')
</div>
<!--end cart-->
