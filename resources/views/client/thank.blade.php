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
                        <span class="order-customer-info-meta address-line"></span>
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
                                    Thoong tin đơn hàng #234324324
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

@section('js')
    <script>
        const getLocation = (type, id) => {
            return new Promise((resolve, reject) => {
                $.ajax({
                    url: `https://provinces.open-api.vn/api/${type}/${id}?depth=2`,
                    method: 'GET',
                    success: function (data) {
                        resolve(data);
                    },
                    error: function () {
                        reject(`Không thể tải danh sách ${type === 'p' ? 'Tỉnh/Thành phố' : type === 'd' ? 'Quận/Huyện' : 'Xã/Phường'}.`);
                    }
                });
            });
        };

        const getFullAddress = (addressInline, ward, district, province) => {

            return `${addressInline},${ward},${district},${province}`;
        }
        const address = @json( $order->address);

        async function displayFullAddress(addressDefault) {
            try {
                const province = await getLocation('p', addressDefault.province_id);
                const district = await getLocation('d', addressDefault.district_id);
                const ward = await getLocation('w', addressDefault.ward_id);
                $('input[name="address_id"]').val(addressDefault.id)
                const fullAddress = getFullAddress(addressDefault.address_line, ward.name, district.name, province.name);
                $('.address-line').html(fullAddress);
            } catch (error) {
                console.error(error);
            }
        }

        displayFullAddress(address);
    </script>
@endsection





