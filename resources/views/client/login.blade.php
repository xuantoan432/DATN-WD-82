@extends('client.layouts.master')

@section('title')
   Login
@endsection

@section('content')

<section class="login footer-padding">
    <div class="container">
        <div class="login-section">
            <div class="review-form">
                <h5 class="comment-title">Log In</h5>
                <div class="review-inner-form ">
                    <div class="review-form-name">
                        <label for="email" class="form-label">Email Address**</label>
                        <input type="email" id="email" class="form-control" placeholder="Email">
                    </div>
                    <div class="review-form-name">
                        <label for="password" class="form-label">Password*</label>
                        <input type="password" id="password" class="form-control" placeholder="password">
                    </div>
                    <div class="review-form-name checkbox">
                        <div class="checkbox-item">
                            <input type="checkbox">
                            <span class="address">
                                Remember Me</span>
                        </div>
                        <div class="forget-pass">
                            <p>Forgot password?</p>
                        </div>
                    </div>
                </div>
                <div class="login-btn text-center">
                    <a href="#" class="shop-btn">Log In</a>
                    <span class="shop-account">Dont't have an account ?<a href="create-account.html">Sign Up
                            Free</a></span>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection