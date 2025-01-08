@extends('client.layouts.master')

@section('title')
    Cảm ơn
@endsection

@section('content')
    <div class="container mb-5">
        <div class="row">
            <div class="col-lg-7 col-md-6 col-12 left">
                <div class="checkout-logo">
                    <a href="#" title="">
                        <img src="{{ asset('theme/client/assets/images/logos/logo_header.png') }}" alt=""/>
                    </a>
                </div>
                <hr>

                <div class="thank-you">
                    <i
                        class="fa fa-check-circle"
                        aria-hidden="true"
                    ></i>
                    <div class="d-inline-block">
                        <h3 class="thank-you-sentence">
                            Đơn hàng của bạn đã được đặt thành công
                        </h3>
                        <p>Cảm ơn bạn đã mua sản phẩm của chúng tôi</p>
                    </div>
                </div>

                <div class="order-customer-info">
                    <h3> Thông tin khách hàng</h3>
                    <p>
                        <span class="d-inline-block">Họ và tên:</span>
                        <span class="order-customer-info-meta">{{ $order->address->details->full_name }}</span>

                    <p>
                        <span class="d-inline-block">Số điện thoại:</span>
                        <span class="order-customer-info-meta">{{ $order->address->details->phone_number }}</span>
                    </p>
                    <p>
                        <span class="d-inline-block">Email:</span>
                        <span class="order-customer-info-meta">{{ $order->user->email }}</span>
                    </p>
                    <p>
                        <span class="d-inline-block">Địa chỉ:</span>
                        <span class="order-customer-info-meta">{{ $order->address->full_address }}</span>
                    </p>
                    <p>
                        <span class="d-inline-block">Phương thức thanh toán:</span>
                        <span class="order-customer-info-meta">{{ $order->payment_method_id }}</span>
                    </p>
                    <p>
                        <span class="d-inline-block">Trạng thái thanh toán:</span>
                        <span
                            class="order-customer-info-meta"
                            style="text-transform: uppercase"
                        >{{ $order->paymentStatus->name }}</span>
                    </p>
                </div>

                <a class="btn payment-checkout-btn" href="{{ route('home.index') }}">Tiếp tục mua sắm </a>
            </div>
            <div class="col-lg-5 col-md-6 d-none d-md-block right">

                <div class="pt-3 mb-4">
                    <div class="align-items-center">
                        <h6 class="d-inline-block fs-3">Mã đơn hàng: {{ $order->order_code }}</h6>
                    </div>

                    <div class="checkout-success-products">
                        <div class="row show-cart-row d-md-none p-2">
                            <div class="col-9">
                                <a
                                    class="show-cart-link"
                                    data-bs-toggle="collapse"
                                    data-bs-target="{{ '#cart-item-' }}"
                                    href="javascript:void(0);"
                                >
                                    Thông tin đơn hàng #234324324
                                    <i
                                        class="fa fa-angle-down"
                                        aria-hidden="true"
                                    ></i>
                                </a>
                            </div>
                            <div class="col-3">
                                <p class="text-end mobile-total"> đ 900000 </p>
                            </div>
                        </div>
                        <div class="collapse collapse-products" id="">
                            @php
                                $total = 0;
                            @endphp
                            @foreach($order->orderDetails as $product)
                                @php
                                    $total += $product->quantity * $product->price;
                                @endphp
                                <div class="row cart-item">
                                <div class="col-lg-3 col-md-3">
                                    <div class="checkout-product-img-wrapper">
                                        <img
                                            class="item-thumb img-thumbnail img-rounded"
                                            src="{{ \Storage::url($product->image) }}"
                                            alt=""
                                        >
                                        <span class="checkout-quantity">{{ $product->quantity }}</span>
                                    </div>
                                </div>
                                <div class="col-lg-5 col-md-5">
                                    <p class="mb-0">{{ $product->name }}</p>
                                    <p class="mb-0">
                                        <ul>
                                            @foreach($product->productVariant->attributes as $attributeValue)
                                            <li>{{ $attributeValue->attribute->name }}: <small>{{ $attributeValue->value }}</small></li>
                                            @endforeach
                                        </ul>

                                    </p>
                                </div>
                                <div class="col-lg-4 col-md-4 col-4 float-end text-end">
                                    <p>{{ number_format($product->price, 0, ',', '.') }}</p>
                                </div>
                            </div>
                            @endforeach
                            <div class="row">
                                <div class="col-6">
                                    <p>Tạm tính:</p>
                                </div>
                                <div class="col-6 float-end">
                                    <p class="price-text text-end"> {{ number_format($total, 0, ',', '.') }} đ</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <p>Giảm giá:</p>
                                </div>
                                <div class="col-6 float-end">
                                    <p class="price-text text-end"> {{ number_format($order->total_price - $total, 0, ',', '.') }} đ</p>
                                </div>
                            </div>
                            <hr>

                            <div class="row">
                                <div class="col-6">
                                    <p>Tổng tiền:</p>
                                </div>
                                <div class="col-6 float-end">
                                    <p class="total-text raw-total-text">{{ number_format($order->total_price, 0, ',', '.') }} đ</p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('css')
    <style>
        /*sfdsf */
        .h1, .h2, .h3, .h4, .h5, .h6, h1, h2, h3, h4, h5, h6 {
            color: #000;
            font-weight: 500;
            line-height: 1.2;
            margin-bottom: .5rem;
            margin-top: 0
        }

        .h1, h1 {
            font-size: calc(1.375rem + 1.5vw)
        }

        @media (min-width: 1200px) {
            .h1, h1 {
                font-size: 2.5rem
            }
        }

        .h2, h2 {
            font-size: calc(1.325rem + .9vw)
        }

        @media (min-width: 1200px) {
            .h2, h2 {
                font-size: 2rem
            }
        }

        .h3, h3 {
            font-size: calc(1.3rem + .6vw)
        }

        @media (min-width: 1200px) {
            .h3, h3 {
                font-size: 1.75rem
            }
        }

        .h4, h4 {
            font-size: calc(1.275rem + .3vw)
        }

        @media (min-width: 1200px) {
            .h4, h4 {
                font-size: 1.5rem
            }
        }

        /*.h5, h5 {*/
        /*    font-size: 1.25rem*/
        /*}*/

        .h6, h6 {
            font-size: 1rem
        }

        p {
            margin-bottom: 1rem;
            margin-top: 0
        }

        a {
            text-decoration: none
        }

        .checkout-form-wrapper {
            margin: 30px 0
        }

        .price-text, .total-text {
            color: #4b4b4b;
            float: right;
            font-weight: 700
        }

        .total-text {
            font-size: 1.5em
        }

        .dropdown-menu {
            border: 0 !important;
            padding: 5px
        }

        .checkout-form {
            display: block;
            width: 100%
        }

        input[type=checkbox] {
            cursor: pointer;
            margin: 0 .5rem 0 0;
            position: relative;
            top: 0;
            background: unset !important;
            border: none !important;
            box-shadow: unset !important;
            color: inherit !important;
            font-size: inherit !important;
            height: auto !important;
            padding-left: 0 !important;
            width: auto !important;
        }

        input[type=checkbox]:before {
            border-color: #58b3f0;
            border-style: none none solid solid;
            border-width: 2px;
            content: "";
            height: 5px;
            left: 2px;
            margin: auto;
            position: absolute;
            right: 0;
            top: .2em;
            transform: rotate(-45deg) scale(0);
            transition: transform .4s cubic-bezier(.45, 1.8, .5, .75);
            width: 10px;
            z-index: 1
        }

        input[type=checkbox]:after {
            background: #fff;
            border: 1px solid #c4cdd5;
            border-radius: 3px;
            bottom: 0;
            content: "";
            cursor: pointer;
            height: 16px;
            left: -1px;
            margin: auto;
            position: absolute;
            right: 0;
            top: 0;
            width: 16px
        }

        input[type=checkbox]:checked:before {
            transform: rotate(-45deg) scale(1)
        }

        input[type=checkbox]:checked:after {
            border-color: #58b3f0
        }

        .password-group {
            display: block;
            width: 100%
        }

        .checkout-content-wrap select.form-control:not([size]):not([multiple]) {
            height: calc(2.25rem + 9px)
        }

        .address-item {
            border: 1px dashed #bfbfbf;
            border-radius: 3px;
            box-shadow: none;
            margin-bottom: 10px;
            padding: 10px 20px 0;
            position: relative
        }

        .address-item.is-default {
            border: 1px dashed #090
        }

        .address-item.is-default .default {
            color: #090;
            display: block;
            font-size: 11px;
            position: absolute;
            right: 15px;
            top: 10px
        }

        .address-item .address {
            font-size: 13px;
            margin-bottom: 3px
        }

        .address-item .name {
            font-size: 15px;
            font-weight: 700;
            margin-bottom: 5px
        }

        label {
            font-weight: 400
        }

        .checkout-logo {
            margin-bottom: 20px
        }

        .checkout-logo a img {
            height: 60px;
            max-width: 100%;
            width: auto
        }

        .form-control {
            border: 1px solid #dcdcdc
        }

        .form-control:focus {
            border: 2px solid #058db8
        }

        input.form-control, select.form-control {
            height: 45px
        }

        .form-group {
            margin-bottom: 10px
        }

        .left {
            min-height: 80vh;
            padding-bottom: 50px
        }

        .left, .right {
            padding-top: 40px
        }

        .right {
            position: relative
        }

        .checkout-btn {
            height: 45px
        }

        .payment-checkout-btn, .payment-checkout-btn-step {
            background-color: #ae1c9a;
            color: #fff;
            padding: 15px
        }

        .payment-checkout-btn-step:hover, .payment-checkout-btn:hover {
            background-color: #0f7091 !important;
            color: #fff !important
        }

        .label-success {
            color: #36c6d3
        }

        .label-info {
            color: #659be0
        }

        .label-warning {
            color: #f1c40f
        }

        .label-danger {
            color: #ed6b75
        }

        .product-item {
            margin-bottom: 15px
        }

        .checkout-product-img-wrapper {
            position: relative
        }

        .checkout-quantity {
            background: #a2a2a2;
            border: 1px solid #a2a2a2;
            border-radius: 50%;
            -webkit-border-radius: 50%;
            color: #fff;
            height: 25px;
            line-height: 22px;
            position: absolute;
            right: -7px;
            text-align: center;
            top: -7px;
            width: 25px
        }

        .cart-item {
            margin-bottom: 10px;
            margin-top: 10px
        }

        .show-cart-link {
            display: block;
            font-weight: 700;
            margin-top: 10px;
            padding: 10px 0;
            width: 100%
        }

        .show-cart-link i {
            float: right;
            line-height: 20px
        }

        .mobile-total {
            display: block;
            font-weight: 700;
            margin-top: 10px;
            padding: 10px 0;
            width: 100%
        }

        .show-cart-row {
            border-bottom: 1px solid #cecece;
            border-top: 1px solid #cecece
        }

        .breadcrumb {
            background-color: #fff;
            padding: 10px 0
        }

        .error {
            color: red;
            font-size: .8em
        }

        #checkout-form:after {
            clear: both;
            content: "";
            display: block
        }

        .thank-you {
            margin-bottom: 30px
        }

        .thank-you i {
            color: #ae1c9a;
            font-size: 5em;
            padding-right: 10px
        }

        .thank-you .thank-you-sentence.h3, .thank-you h3.thank-you-sentence {
            color: #000;
            font-size: 22px;
            font-weight: 600
        }

        .thank-you > p {
            color: #737373;
            display: block;
            font-size: 14px;
            margin-bottom: 3px
        }

        @media (min-width: 768px) {
            .checkout-success-products .collapse-products {
                display: block
            }
        }

        .order-customer-info {
            background: var(--light);
            margin: 30px 0;
            padding: 15px 0
        }

        .order-customer-info .h3, .order-customer-info h3 {
            color: #000;
            font-size: 18px;
            font-weight: 400;
            margin-top: 0
        }

        .order-customer-info p {
            color: #737373;
            font-size: 14px;
            margin-bottom: 3px
        }

        .order-customer-info .order-customer-info-meta {
            color: #ae1c9a;
            padding-left: 20px
        }

        .field-has-error {
            border: 1px solid #a94442 !important;
            box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075)
        }

        .btn, .form-control, body {
            font-size: 14px
        }

        .payment-info-loading i, .shipping-info-loading i {
            font-size: 40px
        }

        .payment-info-loading, .payment-info-loading-content, .shipping-info-loading, .shipping-info-loading-content {
            bottom: 0;
            position: absolute;
            right: 0;
            text-align: center;
            top: 0;
            width: 100%;
            z-index: 9999
        }

        .payment-info-loading-content, .shipping-info-loading-content {
            top: 45%
        }

        #shipping-method-wrapper, .select--arrow {
            position: relative
        }

        .select--arrow i, .select--arrow svg {
            color: #ccc;
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            width: 16px
        }

        .select--arrow .form-control {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            height: 40px;
            padding: 0 30px 0 15px
        }

        @media screen and (min-width: 992px) {
            .left {
                border-right: 1px solid #c8c8c8;
                padding-right: 60px
            }

            .right {
                display: block;
                padding-left: 50px
            }
        }

        @media screen and (max-width: 768px) {
            .left, .right {
                height: auto;
                padding: 0 15px
            }

            .order-1, .order-md-2 {
                order: 0 !important
            }

            .checkout-logo {
                margin-top: 20px
            }

            .card-checkout .form-group.mb-3 {
                margin-bottom: 0 !important
            }

            .card-checkout .form-group.mb-3:first-child {
                margin-bottom: 1rem !important
            }

            .card-checkout .form-group.mb-3 .form-control {
                margin-bottom: 15px
            }
        }

        @media only screen and (min-device-width: 320px) and (max-device-width: 480px) {
            .checkout-content-wrap {
                margin-bottom: 20px
            }

            .checkout-discount-section {
                margin-bottom: 10px
            }

            button.btn.payment-checkout-btn.payment-checkout-btn-step.float-end {
                width: 100%
            }
        }

        @media only screen and (max-width: 320px) {
            .checkout-content-wrap {
                margin-bottom: 20px
            }

            .form-checkout {
                padding: 0 15px
            }

            .checkout-discount-section {
                margin-bottom: 10px
            }

            button.btn.payment-checkout-btn.payment-checkout-btn-step.float-end {
                width: 100%
            }
        }

        .billing-address-form-wrapper .form-control.is-invalid + .invalid-feedback + label, .billing-address-form-wrapper .form-control.is-valid + .invalid-feedback + label, .billing-address-form-wrapper .form-control:-webkit-autofill + label, .billing-address-form-wrapper .form-control:not(:placeholder-shown):focus + label, .billing-address-form-wrapper .form-control:not(:placeholder-shown):valid + label, .billing-address-form-wrapper .form-input-wrapper.select--arrow label, .customer-address-payment-form .form-control.is-invalid + .invalid-feedback + label, .customer-address-payment-form .form-control.is-valid + .invalid-feedback + label, .customer-address-payment-form .form-control:-webkit-autofill + label, .customer-address-payment-form .form-control:not(:placeholder-shown):focus + label, .customer-address-payment-form .form-control:not(:placeholder-shown):valid + label, .customer-address-payment-form .form-input-wrapper.select--arrow label, .customer-tax-information-form .form-control.is-invalid + .invalid-feedback + label, .customer-tax-information-form .form-control.is-valid + .invalid-feedback + label, .customer-tax-information-form .form-control:-webkit-autofill + label, .customer-tax-information-form .form-control:not(:placeholder-shown):focus + label, .customer-tax-information-form .form-control:not(:placeholder-shown):valid + label, .customer-tax-information-form .form-input-wrapper.select--arrow label {
            background: #fff;
            font-size: 12px;
            left: 10px;
            padding: 0 5px;
            top: -7px
        }

        .billing-address-form-wrapper .form-input-wrapper, .customer-address-payment-form .form-input-wrapper, .customer-tax-information-form .form-input-wrapper {
            position: relative
        }

        .billing-address-form-wrapper .form-input-wrapper label, .customer-address-payment-form .form-input-wrapper label, .customer-tax-information-form .form-input-wrapper label {
            color: #6b7078;
            font-size: 14px;
            left: 0;
            padding: 14px;
            pointer-events: none;
            position: absolute;
            top: 0;
            transition: all .2s ease;
            -moz-transition: all .2s ease;
            -webkit-transition: all .2s ease
        }

        .billing-address-form-wrapper .select--arrow .form-control.is-valid, .customer-address-payment-form .select--arrow .form-control.is-valid, .customer-tax-information-form .select--arrow .form-control.is-valid {
            background-image: none
        }

        .checkout__coupon-section {
            margin-top: 2rem;
            position: relative
        }

        .checkout__coupon-heading {
            align-items: center;
            background: #fff;
            border: 1px solid #058db8;
            border-radius: 5px;
            color: #058db8;
            display: flex;
            font-size: 14px;
            font-weight: 600;
            gap: .25rem;
            inset-inline-start: 1rem;
            margin-bottom: 0;
            padding: .25rem .5rem;
            position: absolute;
            top: -1rem;
            z-index: 999
        }

        .checkout__coupon-heading img {
            height: 1.5rem;
            width: 1.5rem
        }

        .checkout__coupon-list {
            border: 1px dashed #058db8;
            border-radius: 8px;
            display: flex;
            flex-direction: column;
            gap: .75rem;
            margin-bottom: 1rem;
            max-height: 600px;
            overflow-y: auto;
            padding: 2rem .75rem .75rem
        }

        .checkout__coupon-item {
            border-radius: 8px;
            box-shadow: 0 0 4px 0 hsla(0, 0%, 80%, .75);
            cursor: pointer;
            display: flex;
            min-width: 16rem;
            transition: all .2s
        }

        .checkout__coupon-item.active {
            background: #058db8;
            color: #fff
        }

        .checkout__coupon-item:hover {
            border-color: #058db8
        }

        .checkout__coupon-item-content {
            flex: 2;
            padding: .5rem 1rem;
            position: relative
        }

        .checkout__coupon-item-title .h4, .checkout__coupon-item-title h4 {
            color: #058db8;
            display: inline-block;
            font-size: 16px;
            font-weight: 700
        }

        .checkout__coupon-item.active .checkout__coupon-item-title .h4, .checkout__coupon-item.active .checkout__coupon-item-title h4 {
            color: #fff
        }

        .checkout__coupon-item-count {
            display: inline-block;
            font-size: .8em;
            font-style: italic;
            font-weight: 400
        }

        .checkout__coupon-item-description {
            color: #4d4d4d;
            display: block;
            font-size: 13px;
            min-width: 135px;
            transition: all .2s
        }

        .checkout__coupon-item.active .checkout__coupon-item-description {
            color: #fff
        }

        .checkout__coupon-item-code {
            align-items: center;
            background: #efefef;
            border-radius: 4px;
            display: flex;
            justify-content: space-between;
            margin-top: .5rem;
            padding: .5rem
        }

        .checkout__coupon-item-code span {
            font-weight: 700
        }

        .checkout__coupon-item.active .checkout__coupon-item-code {
            background: #0c80a4
        }

        .checkout__coupon-item-code button {
            background: #058db8;
            border: none;
            border-radius: 4px;
            box-sizing: border-box;
            color: #fff;
            cursor: pointer;
            font-size: .8em;
            padding: .25rem .75rem;
            transition: all .2s
        }

        .checkout__coupon-item.active .checkout__coupon-item-code button {
            background: #fff;
            border: 1px solid #058db8;
            color: #058db8
        }

        .coupon-wrapper input {
            border-bottom-right-radius: 0;
            border-top-right-radius: 0
        }

        .coupon-wrapper .apply-coupon-code, .coupon-wrapper .remove-coupon-code {
            border: none;
            box-sizing: border-box;
            cursor: pointer;
            outline: none;
            padding: .25rem .75rem;
            transition: all .2s
        }

        .coupon-wrapper .remove-coupon-code {
            background: #fff;
            border: 1px solid #058db8;
            border-radius: 4px;
            color: #058db8;
            font-size: .8em
        }

        .coupon-wrapper .apply-coupon-code {
            background: #058db8;
            border-bottom-right-radius: 4px;
            border-top-right-radius: 4px;
            color: #fff
        }

        .coupon-wrapper .apply-coupon-code:hover {
            background: #0c80a4
        }

        .user-dashboard .nav-content .address-section .seller-info {
            height: 100%;
        }

        .product-wrapper {
            height: 46.5rem;
        }

        .best-product .product-wrapper {
            height: 34.5rem;
        }
    </style>
@endsection





