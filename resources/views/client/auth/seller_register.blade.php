@extends('client.layouts.master')

@section('title')
    Become Vendor
@endsection

@section('content')
    @include('client.components.breadcrumbs')

    <section class="seller-application product footer-padding">
        <div class="container">
            <div class="seller-application-section">
                <form action="{{ route('register.seller') }}" method="POST">
                    @csrf
                    <div class="row ">
                        <div class="col-lg-7">
                            <div class="row gy-5">
                                <div class="col-lg-12">
                                    <div class="seller-information" data-aos="fade-right">
                                        <h5 class="comment-title">Seller Information</h5>
                                        <p class="paragraph">Fill the form below or write us We will help you as soon as
                                            possible</p>
                                        <div class="review-form">
                                            <div class="review-inner-form ">
                                                <div class="review-form-name">
                                                    <label for="email" class="form-label">Email Address*</label>
                                                    <input type="email" id="email" class="form-control"
                                                        placeholder="Enter your email address">
                                                </div>
                                                <div class="review-form-name">
                                                    <label for="phone" class="form-label">Phone*</label>
                                                    <input type="number" id="phone" class="form-control"
                                                        placeholder="+88013**977957">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="seller-information" data-aos="fade-right">
                                        <h5 class="comment-title">Shop Information</h5>
                                        <p class="paragraph">Fill the form below or write us We will help you as soon as
                                            possible</p>
                                        <div class="review-form">
                                            <div class="review-inner-form ">
                                                <div class="review-form-name">
                                                    <label for="name" class="form-label">Shop Name*</label>
                                                    <input type="text" id="name" class="form-control" placeholder="Name">
                                                </div>
                                                <div class="review-form-name">
                                                    <label for="address" class="form-label">Address*</label>
                                                    <input type="text" id="address" class="form-control"
                                                        placeholder="Address">
                                                </div>
                                                <div class="review-form-name checkbox">
                                                    <input type="checkbox">
                                                    <label for="address" class="form-label">
                                                        I agree all terms and condition in ShopUs</label>
                                                </div>
                                                <div class="form-btn">
                                                    <a href="create-account.html" class="shop-btn">Create Seller Account</a>
                                                    <span class="shop-account">Already have an Account?<a
                                                            href="login.html">Log
                                                            in</a></span>
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
                                        <div class="logo-wrapper">
                                            <h5 class="comment-title">Update Logo</h5>

                                    <img src="/theme/client/assets/images/homepage-one/about/signup.webp" height="" alt="img">

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="logo-wrapper cover">


                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
