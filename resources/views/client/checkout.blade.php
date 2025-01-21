@extends('client.layouts.master')

@section('title')
  Checkout
@endsection

@section('content')
@include('client.components.breadcrumbs')
<section class="checkout product footer-padding">
    <div class="container">
        <div class="checkout-section">
            <div class="row gy-5">
                <div class="col-lg-12 ">
                    <div class="border rounded-3">
                        <div class="address-ship"></div>
                        <div class="address-content">
                            <div class="address-top">
                                <i class="fa-solid fa-location-dot"></i>
                                <p>Địa chỉ nhận hàng</p>
                            </div>
                            <div class="address-botton">
                                <div class="address-info">
                                    <div class="name"></div>
                                    <div class="address-line"></div>
                                    <div class="address-deafault">Mặc định</div>
                                </div>
                                <button class="change-address" data-bs-toggle="modal" data-bs-target="#exampleModal">Thay đổi</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="checkout-wrapper">
                        <div class="account-section billing-section">
                            <h5 class="wrapper-heading">Tóm tắt đơn hàng</h5>
                            <div class="order-summery">
                                <div class="subtotal product-total text-center">
                                    <div class="col-6">
                                        <h5 class="wrapper-heading">SẢN PHẨM</h5>
                                    </div>
                                    <div class="col-2">
                                        <h5 class="wrapper-heading">GIÁ</h5>
                                    </div>
                                    <div class="col-2">
                                        <h5 class="wrapper-heading">SỐ LƯỢNG</h5>
                                    </div>
                                    <div class="col-2">
                                        <h5 class="wrapper-heading">SỐ TIỀN</h5>
                                    </div>

                                </div>
                                <hr>
                                <div class="subtotal product-total">
                                    <ul class="product-list">
                                        @php
                                            $total = 0;
                                        @endphp
                                        @foreach($cartItems as $cartItem)
                                            @php
                                                $total += $cartItem->productVariant->getCurrentPrice() * $cartItem->quantity
                                            @endphp
                                        <li>
                                            <div class="d-flex col-6 justify-content-center gap-5">
                                                <div class="wrapper-img">
                                                    <img src="{{ \Storage::url($cartItem->productVariant->image) }}" alt="img">
                                                </div>
                                                <div class="product-info">
                                                    <h5 class="wrapper-heading">{{ $cartItem->productVariant->product->name }}</h5>
                                                    <p class="paragraph">
                                                        @php
                                                            foreach ($cartItem->productVariant->attributes as $attributeValue) {
                                                                 echo $attributeValue->value . ',';
                                                             }
                                                        @endphp
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-2 text-center">
                                                <h5 class="wrapper-heading"> ₫{{ number_format($cartItem->productVariant->getCurrentPrice(), 0, ',', '.') }}</h5>
                                            </div>
                                            <div class="col-2 text-center">
                                                <h5 class="wrapper-heading">{{ $cartItem->quantity }}</h5>
                                            </div>
                                            <div class="col-2 text-center">
                                                <h5 class="wrapper-heading">đ {{ number_format($cartItem->productVariant->getCurrentPrice() * $cartItem->quantity, 0, ',', '.') }}</h5>
                                            </div>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-end text-end my-4">
                                    <form id="cart-coupon" class="cart-coupon">
                                        <h4>Phiếu giảm giá</h4>
                                        <p>Nhập mã phiếu giảm giá của bạn nếu bạn có.</p>
                                        <div class="cuppon-form">
                                            <input type="text" id="coupon-code" placeholder="Coupon code" />
                                            <input type="hidden" id="cart_total" value="{{ $total }}" />
                                            <input type="hidden" id="user_id" value="{{ auth()->id() }}" />
                                            <input type="hidden" id="discount_value" value="0" />
                                            <input type="hidden" id="voucher_previous" value="0" />
                                            <input type="submit" value="Apply Coupon" />
                                        </div>
                                    </form>
                                </div>
                                <div class="d-block text-end" id="coupon-message"></div>
                                <div class="subtotal product-total">
                                    <h5 class="wrapper-heading">TỔNG TIỀN PHỤ</h5>
                                    <h5 class="wrapper-heading"> {{ number_format($total, 0, ',', '.') }} ₫</h5>
                                </div>
                                <div class="subtotal product-total">
                                    <ul class="product-list fee">
                                        <li>
                                            <div class="product-info">
                                                <p class="paragraph">Giảm giá</p>
                                                <h5 class="wrapper-heading">Giảm giá sản phẩm</h5>
                                            </div>
                                            <div class="price">
                                                <h5 class="wrapper-heading"> 0 ₫</h5>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <form action="{{ route('order.create') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="address_id">
                                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                                    <input type="hidden" name="total_price" value="{{ $total }}">
                                    <input type="hidden" name="cart_items" value="{{ $cartItems }}">
                                    <hr>
                                    <div class="subtotal total">
                                        <h5 class="wrapper-heading">Tổng tiền</h5>
                                        <h5 class="wrapper-heading price"><span class="price wrapper-heading" id="total-amount">{{ number_format($total, 0, ',', '.') }}₫</span></h5>
                                    </div>
                                    <div class="subtotal payment-type">
                                        <label for="momo" class="w-100">
                                            <div class="checkbox-item">
                                                <input type="radio" id="momo" name="payment_method" value="payUrl">
                                                <div class="bank">
                                                    <h5 class="wrapper-heading">MOMO</h5>
                                                    <p class="paragraph">
                                                        <img
                                                            src="{{ asset('theme/client/assets/images/payment/momo.png') }}"
                                                            width="100">
                                                    </p>
                                                </div>
                                            </div>
                                        </label>
                                        <label for="cash" class="w-100">
                                            <div class="checkbox-item">
                                                <input type="radio" id="cash" name="payment_method" value="cash">
                                                <div class="cash">
                                                    <h5 class="wrapper-heading">Thanh toán bằng tiền mặt</h5>
                                                </div>
                                            </div>
                                        </label>
                                    </div>
                                    <div class="mb-3">
                                        <p class="paragraph">Ghi chú đặt hàng</p>
                                        <textarea name="note" id="" class="form-control" style="max-width: unset !important;"></textarea>
                                    </div>
                                    <button type="submit" class="shop-btn">Đặt hàng ngay</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content" id="modal-address">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel" style="color: #ae1c9a;"> Địa chỉ của tôi</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="popup-address">
                    <div id="all-address">
                        @foreach($allAddresses as $address)
                            <div class="address-item row">
                            <div class="col-9">
                                <div class="d-flex">
                                    <input type="radio" name="address" id="address{{ $loop->index }}" value="{{ $address->id }}" @checked($addressDefautl->id === $address->id)>
                                    <label for="address{{ $loop->index }}"><strong>{{ $address->details->full_name }}</strong> {{ $address->details->phone_number }}  <p class="mb-3">{{ $address->full_address }}</p></label>
                                </div>
                                @if($addressDefautl->id === $address->id)
                                    <span class="default-label address-deafault">Mặc định</span>
                                @endif
                            </div>
                            
                        </div>
                        @endforeach
                    </div>
                

                    <!-- Action Buttons -->
                    <div class="action-buttons">
                        <button class="cancel-button" data-bs-dismiss="modal">Hủy</button>
                        <button class="confirm-button">Xác nhận</button>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@endsection
@section('js')
    <script>
        const addressDefault = @json($addressDefautl);
        const line_address = '{{ $addressDefautl?->full_address }}';
        const allAddresses = @json($allAddresses);
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    @vite('resources/js/client/order.js')
    <script>
        @if ($errors->any())
            @foreach ($errors->all() as $error)
            toastr.error( '{{ $error }}');
            @endforeach
        @endif
        @if(session('error'))
            toastr.error( '{{ session('error') }}');
        @endif
    </script>
@endsection
