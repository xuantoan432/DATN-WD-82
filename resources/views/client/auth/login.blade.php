@extends('client.layouts.master')

@section('title')
    Login
@endsection

@section('content')
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif
    {{-- @if ($errors->any())
        <div class="text-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif --}}
    <section class="login footer-padding">
        <div class="container">
            <div class="login-section">
                <div class="review-form">
                    <h5 class="comment-title">ĐĂNG NHẬP</h5>
                    <form action="{{ route('login') }}" method="post">
                        @csrf
                        <div class="review-inner-form ">
                            <div class="review-form-name">
                                <label for="email" class="form-label">Địa chỉ email*</label>
                                <input type="email" id="email" name="email"  value="{{ old('email') }}" class="form-control" placeholder="Email"
                                    >
                                @if ($errors->has('email'))
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                            <div class="review-form-name">
                                <label for="password" class="form-label">Mật khẩu*</label>
                                <input type="password" id="password" name="password" class="form-control"
                                    placeholder="Mật khẩu" >
                                @if ($errors->has('password'))
                                    <span class="text-danger">{{ $errors->first('password') }}</span>
                                @endif
                            </div>
                            <div class="review-form-name checkbox">
                                <div class="checkbox-item">
                                    <input type="checkbox">
                                    <span class="address">Ghi nhớ phiên đăng nhập</span>
                                </div>
                                <div class="forget-pass">
                                    <p>Quên mật khẩu?</p>
                                </div>
                            </div>
                        </div>
                        <div class="login-btn text-center">
                            <button class="shop-btn" type="submit">Đăng nhập</button>
                            <span class="shop-account">Bạn chưa có tài khoản ?<a href="{{ route('register') }}"><u>Đăng ký tài
                                        khoản mới</u></a></span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
