@extends('client.profile.layout')
@section('main-content')
    <div class="user-profile">
            <div class="user-title">
                <p class="paragraph">Xin chào, {{ $user->name }}</p>
                <h5 class="heading">Chào mừng đến với hồ sơ của bạn </h5>
            </div>
            <div class="profile-section">
                <div class="row g-5">
                    <div class="col-lg-4 col-sm-6">
                        <div class="product-wrapper">
                            <div class="wrapper-img">
                                                    <span>
                                                        <svg width="62" height="62" viewBox="0 0 62 62"
                                                             fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <rect width="62" height="62" rx="4" />
                                                            <path
                                                                d="M45.4473 20.0309C45.482 20.3788 45.5 20.7314 45.5 21.0883C45.5 26.919 40.7564 31.6625 34.9258 31.6625C29.0951 31.6625 24.3516 26.919 24.3516 21.0883C24.3516 20.7314 24.3695 20.3788 24.4042 20.0309H21.9805L21.0554 12.6289H13.7773V14.7438H19.1884L21.5676 33.7774H47.1868L48.8039 20.0309H45.4473Z" />
                                                            <path
                                                                d="M22.0967 38.0074H19.0648C17.3157 38.0074 15.8926 39.4305 15.8926 41.1797C15.8926 42.9289 17.3157 44.352 19.0648 44.352H19.2467C19.1293 44.6829 19.0648 45.0386 19.0648 45.4094C19.0648 47.1586 20.4879 48.5816 22.2371 48.5816C24.4247 48.5816 25.9571 46.4091 25.2274 44.352H35.1081C34.377 46.413 35.9157 48.5816 38.0985 48.5816C39.8476 48.5816 41.2707 47.1586 41.2707 45.4094C41.2707 45.0386 41.2061 44.6829 41.0888 44.352H43.3856V42.2371H19.0648C18.4818 42.2371 18.0074 41.7628 18.0074 41.1797C18.0074 40.5966 18.4818 40.1223 19.0648 40.1223H46.4407L46.9384 35.8926H21.8323L22.0967 38.0074Z" />
                                                            <path
                                                                d="M34.9262 29.5477C39.5907 29.5477 43.3856 25.7528 43.3856 21.0883C43.3856 16.4238 39.5907 12.6289 34.9262 12.6289C30.2616 12.6289 26.4668 16.4238 26.4668 21.0883C26.4668 25.7528 30.2617 29.5477 34.9262 29.5477ZM33.8688 17.916H35.9836V20.6503L37.7886 22.4554L36.2932 23.9508L33.8687 21.5262V17.916H33.8688Z" />
                                                        </svg>
                                                    </span>
                            </div>
                            <div class="wrapper-content">
                                <p class="paragraph">New Orders</p>
                                <h3 class="heading">656</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="product-wrapper">
                            <div class="wrapper-img">
                                                    <span>
                                                        <svg width="62" height="62" viewBox="0 0 62 62"
                                                             fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <rect width="62" height="62" rx="4"
                                                                  fill="white" />
                                                            <path
                                                                d="M45.2253 29.8816H44.4827L43.6701 26.3651C43.376 25.1043 42.2552 24.2217 40.9662 24.2217H36.8474V20.8453C36.8474 19.038 35.3764 17.5811 33.5831 17.5811H18.1724C16.4631 17.5811 15.0762 18.968 15.0762 20.6772V37.0967C15.0762 38.8058 16.4631 40.1928 18.1724 40.1928H19.2931C19.8955 42.1962 21.7448 43.6533 23.9304 43.6533C26.1159 43.6533 27.9792 42.1962 28.5816 40.1928C28.8455 40.1928 35.3459 40.1928 35.1942 40.1928C35.7966 42.1962 37.6459 43.6533 39.8315 43.6533C42.031 43.6533 43.8803 42.1962 44.4827 40.1928H45.2253C46.7663 40.1928 47.9992 38.9599 47.9992 37.4189V32.6555C47.9992 31.1145 46.7663 29.8816 45.2253 29.8816ZM23.9304 40.8513C22.7897 40.8513 21.8849 39.8969 21.8849 38.7918C21.8849 37.657 22.7956 36.7324 23.9304 36.7324C25.0652 36.7324 25.9898 37.657 25.9898 38.7918C25.9898 39.9151 25.0692 40.8513 23.9304 40.8513ZM28.9739 25.0622L24.799 28.3125C24.2023 28.7767 23.3035 28.6903 22.8236 28.0604L21.2125 25.9449C20.7361 25.3284 20.8622 24.4458 21.4787 23.9835C22.0811 23.5072 22.9637 23.6332 23.4401 24.2496L24.1966 25.2303L27.2507 22.8487C27.8531 22.3864 28.7357 22.4845 29.2121 23.1009C29.6884 23.7173 29.5763 24.586 28.9739 25.0622ZM39.8315 40.8513C38.6906 40.8513 37.7861 39.8969 37.7861 38.7918C37.7861 37.657 38.7107 36.7324 39.8315 36.7324C40.9662 36.7324 41.8909 37.657 41.8909 38.7918C41.8909 39.9166 40.9683 40.8513 39.8315 40.8513ZM37.618 27.0236H40.2798C40.6021 27.0236 40.8962 27.2337 41.0083 27.542L41.8629 30.0497C42.031 30.5541 41.6667 31.0724 41.1344 31.0724H37.618C37.1976 31.0724 36.8474 30.7222 36.8474 30.3019V27.7942C36.8474 27.3739 37.1976 27.0236 37.618 27.0236Z"
                                                                fill="#FFBB38" />
                                                        </svg>
                                                    </span>
                            </div>
                            <div class="wrapper-content">
                                <p class="paragraph">Delivery Completed</p>
                                <h3 class="heading">99783</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="product-wrapper">
                            <div class="wrapper-img">
                                                    <span>
                                                        <svg width="62" height="62" viewBox="0 0 62 62"
                                                             fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <rect width="62" height="62" rx="4"
                                                                  fill="white" />
                                                            <path
                                                                d="M26.7975 34.4331C23.7162 36.0289 22.9563 36.8019 21.6486 39.6816C20.7665 38.8387 19.9011 38.0123 19.0095 37.1599C19.5288 36.3146 20.0327 35.4942 20.5353 34.6726C20.8803 34.1071 20.4607 33.0579 19.8228 32.899C18.8862 32.6666 17.9484 32.4426 17 32.2114C17 30.4034 17 28.6274 17 26.7827C17.9212 26.561 18.8542 26.3405 19.7849 26.1117C20.4678 25.9433 20.8922 24.9048 20.527 24.306C20.0339 23.4987 19.5371 22.6925 19.0605 21.916C20.3551 20.6201 21.6225 19.354 22.9243 18.0534C23.7067 18.5335 24.5283 19.0398 25.3535 19.5425C25.887 19.8673 26.9433 19.4452 27.0927 18.8442C27.3262 17.9064 27.5491 16.965 27.7839 16C29.5883 16 31.3785 16 33.2197 16C33.4366 16.907 33.6548 17.8234 33.8777 18.7386C34.0555 19.4678 35.0763 19.8969 35.7082 19.5093C36.5144 19.0149 37.3182 18.5205 38.0829 18.051C39.3763 19.3445 40.6318 20.6 41.943 21.9124C41.4783 22.6723 40.9756 23.4904 40.4753 24.3108C40.1114 24.9071 40.5405 25.9398 41.2258 26.1081C42.1434 26.3334 43.0646 26.5503 44 26.7756C44 28.5954 44 30.3892 44 32.2197C43.1298 32.426 42.2667 32.6287 41.4048 32.8338C40.4658 33.0579 40.0651 34.0122 40.5654 34.8267C41.029 35.5819 41.4914 36.3383 41.9727 37.122C41.1487 38.004 40.3473 38.8612 39.4901 39.7776C38.5393 37.1741 36.8297 35.4243 34.3163 34.4592C37.5565 31.5332 36.8558 27.4668 34.659 25.411C32.2973 23.1999 28.5995 23.2616 26.3138 25.5639C24.1537 27.7406 23.7186 31.6885 26.7975 34.4331Z"
                                                                fill="#FFBB38" />
                                                            <path
                                                                d="M38.0695 46.3142C33.0415 46.3142 28.0847 46.3142 23.0389 46.3142C23.0389 45.9763 23.0342 45.6491 23.0401 45.3219C23.0626 44.0391 22.9796 42.7421 23.1361 41.4747C23.5357 38.2571 26.1261 35.9239 29.3722 35.8208C30.5886 35.7817 31.8417 35.7757 33.0249 36.0164C35.8643 36.595 37.8916 39.0254 38.0552 41.9359C38.1359 43.3704 38.0695 44.8133 38.0695 46.3142Z"
                                                                fill="#FFBB38" />
                                                            <path
                                                                d="M30.5375 33.9233C28.2244 33.9091 26.3501 32.011 26.3832 29.7193C26.4176 27.4122 28.3169 25.5568 30.6157 25.584C32.8849 25.6101 34.7486 27.5011 34.7403 29.7691C34.7332 32.075 32.8481 33.9375 30.5375 33.9233Z"
                                                                fill="#FFBB38" />
                                                        </svg>
                                                    </span>
                            </div>
                            <div class="wrapper-content">
                                <p class="paragraph">Support Tickets</p>
                                <h3 class="heading">09</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="info-section">
                            <div class="seller-info">
                                <h5 class="heading">Thông tin cá nhân</h5>
                                <div class="info-list">
                                    <div class="info-title">
                                        <p>Tên tài khoản:</p>
                                        <p>Email:</p>
                                        <p>Số điện thoại:</p>
                                        <p>Giới tính:</p>
                                        <p>Ngày sinh:</p>
                                    </div>
                                    <div class="info-details">
                                        <p>{{ $user->name ?? 'Thông tin trống' }}</p>
                                        <p>{{ $user->email ?? 'Thông tin trống' }}</p>
                                        <p>{{ $user->phone ?? 'Thông tin trống' }}</p>
                                        <p>{{ $user->gender ?? 'Thông tin trống' }}</p>
                                        <p>{{ $user->dob ?? 'Thông tin trống' }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="devider"></div>
                            <div class="shop-info">
                                <h5 class="heading ">Thông tin cửa hàng</h5>

                                @if ($user->hasRole(2))
                                    <div class="info-list">
                                        <div class="info-title">
                                            <p>Tên cửa hàng:</p>
                                            <p>Email:</p>

                                        </div>
                                        <div class="info-details">
                                            <p>{{ $user->seller?->store_name }}</p>
                                            <p>{{ $user->seller?->store_email }}</p>

                                        </div>
                                    </div>
                                    <a href="{{ route('seller.index') }}" class="btn  p-3 mt-4 "
                                       style="background-color: #ae1c9a; color:#ffffff; font-size:15px">Quản
                                        lý shop</a>
                                @elseif($user->hasRole(1))
                                    <div class="admin-view">
                                        <p>Bạn đang đăng nhập với quyền Admin.</p>
                                    </div>
                                @elseif($user->hasRole(3))
                                    <a href="{{ route('register.seller') }}" class="btn  p-3 mt-4 "
                                       style="background-color: #ae1c9a; color:#ffffff; font-size:15px">Trở
                                        thành nhà bán hàng</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
