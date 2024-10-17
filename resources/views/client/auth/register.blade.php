@extends('client.layouts.master')

@section('title')
    Become Vendor
@endsection

@section('content')
    @include('client.components.breadcrumbs')

    <section class="seller-application product footer-padding">
        <div class="container">
            <div class="seller-application-section">
                <form action="{{ route('register') }}" method="POST">
                    @csrf
                    <div class="row ">
                        <div class="col-lg-7">
                            <div class="row gy-5">
                                <div class="col-lg-12">
                                    <div class="seller-information" data-aos="fade-right">
                                        <h5 class="comment-title">Đăng ký </h5>
                                        <p class="paragraph">Điền vào mẫu dưới đây hoặc viết thư cho chúng tôi Chúng tôi sẽ
                                            giúp bạn trong thời gian sớm nhất
                                            có thể</p>
                                        <div class="review-form">
                                            <div class="review-inner-form ">
                                                <div class="review-form-name">
                                                    <label for="name" class="form-label">Tên</label>
                                                    <input type="name" id="name" value="{{old('name')}}" name="name" class="form-control"
                                                        placeholder="Nhập tên của bạn">
                                                    @if ($errors->has('name'))
                                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                                    @endif
                                                </div>

                                                <div class="review-form-name">
                                                    <label for="phone" class="form-label">Số điện thoại*</label>
                                                    <input type="number" id="phone" value="{{old('phone')}}" name="phone" class="form-control"
                                                        placeholder="+88013**977957">
                                                    @if ($errors->has('phone'))
                                                        <span class="text-danger">{{ $errors->first('phone') }}</span>
                                                    @endif
                                                </div>

                                                <div class="review-form-name">
                                                    <label for="email" class="form-label">Email *</label>
                                                    <input type="email" id="email" value="{{old('email')}}" name="email" class="form-control"
                                                        placeholder="Nhập email của bạn">
                                                    @if ($errors->has('email'))
                                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                                    @endif
                                                </div>

                                                <div class="review-form-name">
                                                    <label for="password" class="form-label">Mật khẩu *</label>
                                                    <input type="password" id="password" name="password"
                                                        class="form-control" placeholder="Nhập mật khẩu">
                                                    @if ($errors->has('password'))
                                                        <span class="text-danger">{{ $errors->first('password') }}</span>
                                                    @endif
                                                </div>

                                                <div class="review-form-name">
                                                    <label for="password" class="form-label">Xác nhận mật khẩu *</label>
                                                    <input type="password" name="password_confirmation" class="form-control"
                                                        placeholder="Xác nhận mật khẩu">
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="seller-information" data-aos="fade-right">
                                        {{-- <h5 class="comment-title">Shop Information</h5>
                                <p class="paragraph">Fill the form below or write us We will help you as soon as
                                    possible</p> --}}
                                        <div class="review-form">
                                            <div class="review-inner-form ">

                                                <div class="review-form-name checkbox">
                                                    <input type="checkbox">
                                                    <label for="address" class="form-label">
                                                        I agree all terms and condition in ShopUs</label>
                                                </div>
                                                <div class="form-btn">

                                                    {{-- <input type="submit" class="shop-btn" value="Tạo tài khoản"/> --}}
                                                    <button type="submit" class="shop-btn">Đăng ký</button>
                                                    <span class="shop-account">Đã có tài khoản<a href="login.html">
                                                            Đăng nhập</a></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="img-upload-section" data-aos="fade-left">
                                <div class="row">
                                    <div class="col-lg-12">
                                   
                                    <img src="/theme/client/assets/images/homepage-one/about/gau.jpg" height="650px" alt="img">

                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
