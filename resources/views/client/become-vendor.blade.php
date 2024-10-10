@extends('client.layouts.master')

@section('title')
  Become Vendor
@endsection

@section('content')

@include('client.components.breadcrumbs')

<section class="seller-application product footer-padding">
    <div class="container">
        <div class="seller-application-section">
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
                                    <p class="paragraph">Profile of at least Size300x300. Gifs work too.Max 5mb.</p>
                                    <div class="logo-upload">
                                        <img src="/themes/client/assets/images/homepage-one/sallers-cover.png" alt="upload"
                                            class="upload-img" id="upload-img">
                                        <div class="input-item upload-input">
                                            <label for="input-file">
                                                <span>
                                                    <svg width="32" height="32" viewBox="0 0 32 32" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M16.5147 11.5C17.7284 12.7137 18.9234 13.9087 20.1296 15.115C19.9798 15.2611 19.8187 15.4109 19.6651 15.5683C17.4699 17.7635 15.271 19.9587 13.0758 22.1539C12.9334 22.2962 12.7948 22.4386 12.6524 22.5735C12.6187 22.6034 12.5663 22.6296 12.5213 22.6296C11.3788 22.6334 10.2362 22.6297 9.09365 22.6334C9.01498 22.6334 9 22.6034 9 22.536C9 21.4009 9 20.2621 9.00375 19.1271C9.00375 19.0746 9.02997 19.0109 9.06368 18.9772C10.4123 17.6249 11.7609 16.2763 13.1095 14.9277C14.2295 13.8076 15.3459 12.6913 16.466 11.5712C16.4884 11.5487 16.4997 11.5187 16.5147 11.5Z"
                                                            fill="white"></path>
                                                        <path
                                                            d="M20.9499 14.2904C19.7436 13.0842 18.5449 11.8854 17.3499 10.6904C17.5634 10.4694 17.7844 10.2446 18.0054 10.0199C18.2639 9.76139 18.5261 9.50291 18.7884 9.24443C19.118 8.91852 19.5713 8.91852 19.8972 9.24443C20.7251 10.0611 21.5492 10.8815 22.3771 11.6981C22.6993 12.0165 22.7105 12.4698 22.3996 12.792C21.9238 13.2865 21.4443 13.7772 20.9686 14.2717C20.9648 14.2792 20.9536 14.2867 20.9499 14.2904Z"
                                                            fill="white"></path>
                                                    </svg>
                                                </span>
                                            </label>
                                            <input type="file" accept="image/jpeg, image/jpg, image/png, image/webp"
                                                id="input-file">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="logo-wrapper cover">
                                    <h5 class="comment-title">Update Cover</h5>
                                    <p class="paragraph">Cover of at least Size 1170x920.</p>
                                    <div class="cover-upload logo-upload">
                                        <img src="/themes/client/assets/images/homepage-one/sallers-cover.png" alt="upload"
                                            class="cover-img" id="cover-img">
                                        <div class="input-item cover-input">
                                            <label for="cover-file">
                                                <span>
                                                    <svg width="32" height="32" viewBox="0 0 32 32" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M16.5147 11.5C17.7284 12.7137 18.9234 13.9087 20.1296 15.115C19.9798 15.2611 19.8187 15.4109 19.6651 15.5683C17.4699 17.7635 15.271 19.9587 13.0758 22.1539C12.9334 22.2962 12.7948 22.4386 12.6524 22.5735C12.6187 22.6034 12.5663 22.6296 12.5213 22.6296C11.3788 22.6334 10.2362 22.6297 9.09365 22.6334C9.01498 22.6334 9 22.6034 9 22.536C9 21.4009 9 20.2621 9.00375 19.1271C9.00375 19.0746 9.02997 19.0109 9.06368 18.9772C10.4123 17.6249 11.7609 16.2763 13.1095 14.9277C14.2295 13.8076 15.3459 12.6913 16.466 11.5712C16.4884 11.5487 16.4997 11.5187 16.5147 11.5Z"
                                                            fill="white"></path>
                                                        <path
                                                            d="M20.9499 14.2904C19.7436 13.0842 18.5449 11.8854 17.3499 10.6904C17.5634 10.4694 17.7844 10.2446 18.0054 10.0199C18.2639 9.76139 18.5261 9.50291 18.7884 9.24443C19.118 8.91852 19.5713 8.91852 19.8972 9.24443C20.7251 10.0611 21.5492 10.8815 22.3771 11.6981C22.6993 12.0165 22.7105 12.4698 22.3996 12.792C21.9238 13.2865 21.4443 13.7772 20.9686 14.2717C20.9648 14.2792 20.9536 14.2867 20.9499 14.2904Z"
                                                            fill="white"></path>
                                                    </svg>
                                                </span>
                                            </label>
                                            <input type="file" accept="image/jpeg, image/jpg, image/png, image/webp"
                                                id="cover-file">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>  
@endsection

