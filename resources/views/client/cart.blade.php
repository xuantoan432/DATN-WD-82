@extends('client.layouts.master')

@section('title')
    Cart
@endsection

@section('content')

    @include('client.components.breadcrumbs')

    <section class="product-cart product footer-padding">
        @if(!$cartItems->isEmpty())
        <div class="container">
            <div class="cart-section">
                <table>
                    <tbody>
                    <tr class="table-row table-top-row">
                        <td class="table-wrapper wrapper-product">
                            <h5 class="table-heading">Sản phẩm</h5>
                        </td>
                        <td class="table-wrapper">
                            <h5 class="table-heading">Thuộc tính</h5>
                        </td>
                        <td class="table-wrapper">
                            <div class="table-wrapper-center">
                                <h5 class="table-heading">Giá</h5>
                            </div>
                        </td>
                        <td class="table-wrapper">
                            <div class="table-wrapper-center">
                                <h5 class="table-heading">Số lượng</h5>
                            </div>
                        </td>
                        <td class="table-wrapper wrapper-total">
                            <div class="table-wrapper-center">
                                <h5 class="table-heading">Tổng</h5>
                            </div>
                        </td>
                        <td class="table-wrapper">
                            <div class="table-wrapper-center">
                                <h5 class="table-heading">Thao tác</h5>
                            </div>
                        </td>
                    </tr>
                    @php
                        $total = 0;
                    @endphp
                    @foreach($cartItems as $cartItem)
                        @php
                            $total += $cartItem->productVariant->getCurrentPrice() * $cartItem->quantity
                        @endphp
                        <tr class="table-row ticket-row">
                            <td class="table-wrapper wrapper-product">
                                <div class="wrapper">
                                    <div class="wrapper-img">
                                        <img src="{{ \Storage::url($cartItem->productVariant->image) }}" alt="img">
                                    </div>
                                    <a href="{{ route('home.product-detail', $cartItem->productVariant->product) }}"
                                       class="wrapper-content">
                                        <h5 class="heading">{{ $cartItem->productVariant->product->name }}</h5>
                                    </a>
                                </div>
                            </td>
                            <td class="table-wrapper">
                                <div class="table-wrapper-center justify-content-start">
                                    <h5 class="heading text-start">
                                       @php
                                           foreach ($cartItem->productVariant->attributes as $attributeValue) {
                                                echo '<p><strong>' . $attributeValue->attribute->name . "</strong>:"  . $attributeValue->value . "</p>";
                                            }
                                       @endphp
                                    </h5>
                                </div>
                            </td>
                            <td class="table-wrapper">
                                <div class="table-wrapper-center ">
                                    <h5 class="heading">
                                        ₫{{ number_format($cartItem->productVariant->getCurrentPrice(), 0, ',', '.') }}</h5>
                                </div>
                            </td>
                            <td class="table-wrapper">
                                <div class="table-wrapper-center">
                                    <div class="product-quantity">
                                        <div class="quantity-wrapper">
                                            <div class="quantity">
                                                <span class="minus">
                                                    -
                                                </span>
                                                <input type="text" readonly class="number quantity-input" id="quantity-{{ $cartItem->id }}" value="{{ $cartItem->quantity }}" data-id="{{ $cartItem->id }}">
                                                <span class="plus">
                                                    +
                                                </span>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="table-wrapper wrapper-total">
                                <div class="table-wrapper-center">
                                    <h5 class="heading total-price" data-unit-price="{{ $cartItem->productVariant->getCurrentPrice() }}">
                                        ₫ <span class="price-tt">{{ number_format($cartItem->productVariant->getCurrentPrice() * $cartItem->quantity, 0, ',', '.') }}</span>
                                    </h5>
                                </div>
                            </td>
                            <td class="table-wrapper">
                                <div class="table-wrapper-center">
                                    <span class="delete-product" data-id="{{ $cartItem->id }}" style="cursor: pointer;">
                                        <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M9.7 0.3C9.3 -0.1 8.7 -0.1 8.3 0.3L5 3.6L1.7 0.3C1.3 -0.1 0.7 -0.1 0.3 0.3C-0.1 0.7 -0.1 1.3 0.3 1.7L3.6 5L0.3 8.3C-0.1 8.7 -0.1 9.3 0.3 9.7C0.7 10.1 1.3 10.1 1.7 9.7L5 6.4L8.3 9.7C8.7 10.1 9.3 10.1 9.7 9.7C10.1 9.3 10.1 8.7 9.7 8.3L6.4 5L9.7 1.7C10.1 1.3 10.1 0.7 9.7 0.3Z"
                                                fill="#AAAAAA"></path>
                                        </svg>
                                    </span>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    <tr class="table-row ticket-row">
                        <td colspan="4"></td>
                        <td class="table-wrapper">
                            <div class="table-wrapper-center">
                                <h5 class="heading" id="cart-total1">
                                    ₫ {{ number_format($total, 0,',', '.') }}
                                </h5>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="wishlist-btn cart-btn">
                <a href="empty-cart.html" class="clean-btn">Clear Cart</a>
                <a href="#" class="shop-btn update-btn">Update Cart</a>
                <a href="{{ route('checkout.show', $user) }}" class="shop-btn">Proceed to Checkout</a>
            </div>
        </div>
        @else
            <div class="blog-item" data-aos="fade-up">
                <div class="cart-img">
                    <img src="{{ asset('theme/client/assets/images/homepage-one/empty-cart.webp') }}" alt>
                </div>
                <div class="cart-content">
                    <p class="content-title">Giỏ hàng của bạn đang không có sản phẩm nào </p>
                    <a href="{{route('home.shop')}}" class="shop-btn">Quay lại trang sản phẩm</a>
                </div>
            </div>
        @endif
    </section>

@endsection
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@endsection
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    @vite('resources/js/client/cart.js')
@endsection
