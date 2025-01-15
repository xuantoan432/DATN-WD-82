@extends('client.layouts.master')

@section('title')
    Forgot Password
@endsection

@section('content')
    <section class="login footer-padding">
        <div class="container">
            <div class="login-section">
                <div class="review-form">
                    <form method="POST" class="register-form" id="login-form" method="{{ route('auth.forgot') }}">
                        @csrf
                        <h5 class="comment-title">Bạn đã quên mật khẩu ?</h5>
                        <div class="review-inner-form ">
                            <div class="review-form-name">
                                <label for="email" class="form-label">Chúng tôi sẽ giúp bạn </label>
                                <input type="email" id="email" class="form-control" name="email"
                                    placeholder="Vui lòng nhập địa chỉ email đã đăng ký ">
                                @error('email')
                                    <label class="text-danger">{{ $message }}</label>
                                @enderror
                                @if (session('err'))
                                    <label class="text-warning">{{ session('err') }}</label>
                                @endif
                                @if (session('msg'))
                                <label class="text-success">{{ session('msg') }}</label>
                            @endif

                            </div>
                        </div>
                        <div class="login-btn text-center">
                            <button type="submit" class="shop-btn">Xác nhận</button>
                            <span class="shop-account">Bạn chưa có tài khoản ?<a href="{{route('register')}}">Đăng ký
                                </a></span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
