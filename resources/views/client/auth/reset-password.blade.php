@extends('client.layouts.master')

@section('title')
    Forgot Password
@endsection

@section('content')
    <section class="login footer-padding">
        <div class="container">
            <div class="login-section">
                <div class="review-form">
                    @if ($errors->any())
                    <div class="text-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                    <form method="POST" class="register-form" id="login-form" method="{{ route('auth.reset' , $token) }}">
                        @csrf
                        @method('PUT')
                        <h5 class="comment-title">Đổi mật khẩu mới </h5>
                        <div class="review-inner-form ">
                            <div class="review-form-name">
                                <label for="email" class="form-label">Nhập mật khẩu mới </label>
                                <input type="password" id="email" class="form-control" name="password"
                                    placeholder="Vui lòng nhập mật khẩu mới">
                                <label for="email" class="form-label">Xác nhận mật khẩu mới </label>
                                <input type="password" id="email" class="form-control" name="password_confirmation"
                                    placeholder="Xác nhận lại mật khẩu">
                                    <input type="hidden" name="token" value="{{ $token }}">
                            </div>
                        </div>
                        <div class="login-btn text-center">
                            <button type="submit" class="shop-btn">Xác nhận</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
