@extends('client.layouts.master')

@section('title')
    Empty cart
@endsection

@section('content')
<section class="blog about-blog footer-padding">
    <div class="container">
        @include('client.components.breadcrumbs1')
        <div class="blog-item" data-aos="fade-up">
            <div class="cart-img">
                <img src="assets/images/homepage-one/empty-cart.webp" alt>
            </div>
            <div class="cart-content">
                <p class="content-title">Empty! You don’t Cart any Products </p>
                <a href="product-sidebar.html" class="shop-btn">Back to Shop</a>
            </div>
        </div>
    </div>
</section>
@endsection


