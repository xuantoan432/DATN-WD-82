@extends('client.profile.layout')
@section('main-content')
    <div class="user-profile">
            <div class="user-title">
                <p class="paragraph">Xin chào, {{ $user->name }}</p>
                <h5 class="heading">Chào mừng đến với hồ sơ của bạn </h5>
            </div>
            <div class="profile-section">
                <div class="row g-5">
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
