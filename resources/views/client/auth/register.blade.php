@extends('client.layouts.master')

@section('title')
    Đăng ký
@endsection

@section('content')
    <section class="login account footer-padding">
        <div class="container">
            <form action="{{ route('register') }}" method="POST">
                @csrf
                <div class="login-section account-section">
                    <div class="review-form">
                        <h5 class="comment-title">Tạo tài khoản</h5>
                        <div class=" account-inner-form">
                            <div class="review-form-name">
                                <label for="name" class="form-label">Tên</label>
                                <input type="name" id="name" value="{{ old('name') }}" name="name"
                                    class="form-control" placeholder="Nhập tên của bạn">
                                @if ($errors->has('name'))
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>

                            <div class="review-form-name">
                                <label for="phone" class="form-label">Số điện thoại</label>
                                <input type="phone" id="phone" value="{{ old('phone') }}" name="phone"
                                    class="form-control" placeholder="+880388**0899">
                                @if ($errors->has('phone'))
                                    <span class="text-danger">{{ $errors->first('phone') }}</span>
                                @endif
                            </div>

                        </div>
                        <div class=" account-inner-form">
                            <div class="review-form-name">
                                <label for="email" class="form-label">Email *</label>
                                <input type="email" id="email" value="{{ old('email') }}" name="email"
                                    class="form-control" placeholder="Nhập email của bạn">
                                @if ($errors->has('email'))
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                            <div class="review-form-name">
                                <label for="password" class="form-label">Mật khẩu *</label>
                                <input type="password" id="password" name="password" class="form-control"
                                    placeholder="Nhập mật khẩu">
                                @if ($errors->has('password'))
                                    <span class="text-danger">{{ $errors->first('password') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="review-form-name">
                            <label for="password" class="form-label">Xác nhận mật khẩu *</label>
                            <input type="password" name="password_confirmation" class="form-control"
                                placeholder="Xác nhận mật khẩu">
                        </div>
                        <div class="review-form-name checkbox">
                            <div class="checkbox-item">
                                <input type="checkbox">
                                <p class="remember">
                                    Tôi đồng ý với tất cả chính sách<span class="inner-text"> Shop.</span></p>
                            </div>
                        </div>
                        <div class="login-btn text-center">
                            <button type="submit" class="shop-btn">Đăng ký</button>
                            <span class="shop-account">Đã có tài khoản ?<a href="login.html">Log In</a></span>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </section>
@endsection
