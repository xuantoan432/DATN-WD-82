@extends('client.layouts.master')

@section('title')
    Product Detail
@endsection

@section('content')
    <section class="product product-info">
        <div class="container">
            @include('client.components.breadcrumbs1')
            <div class="product-info-section">
                <div class="row ">
                    <div class="col-md-6">
                        <div class="product-info-img" data-aos="fade-right">
                            <div class="swiper product-top">
                                <div class="swiper-wrapper " id="main-product-image">
                                    @foreach ($product->galleries as $image)
                                        <div class="swiper-slide slider-top-img">
                                            <img src="{{ \Storage::url($image->image) }}" alt="img">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="swiper product-bottom">
                                <div class="swiper-wrapper">
                                    @foreach ($product->galleries as $image)
                                        <div class="swiper-slide slider-bottom-img">
                                            <img src="{{ \Storage::url($image->image) }}" alt="img">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="product-info-content" data-aos="fade-left">
                            <span class="wrapper-subtitle">{{ $product->category->name }}</span>
                            <h5>{{ $product->name }}</h5>
                            <div class="ratings">
                                <span class="text-warning fs-4">
                                    @php
                                        $fullStars = floor($averageRating);
                                        $halfStar = $averageRating - $fullStars >= 0.5 ? 1 : 0;

                                    @endphp
                                    ({{ number_format($averageRating, 2) }}/5)
                                    @for ($i = 0; $i < 5; $i++)
                                        @if ($i < $fullStars)
                                            <i class="fa-solid fa-star"></i>
                                        @elseif ($i == $fullStars && $halfStar)
                                            <i class="fa-solid fa-star-half-stroke"></i>
                                        @else
                                            <i class="fa-regular fa-star"></i>
                                        @endif
                                    @endfor
                                </span>
                                <span class="text">{{ $product->reviews()->count() }} Đánh giá</span>
                            </div>
                            <div class="price">
                                @php
                                    $minRegularPrice = min($priceRegulars);
                                    $maxRegularPrice = max($priceRegulars);
                                @endphp

                                @if (!empty($priceSales))
                                    @php
                                        $minSalePrice = min($priceSales);
                                        $maxSalePrice = max($priceSales);
                                    @endphp
                                    <span class="price-cut">₫{{ number_format($minRegularPrice, 0, ',', '.') }} -
                                        ₫{{ number_format($maxRegularPrice, 0, ',', '.') }}</span>
                                    <span class="new-price">₫{{ number_format($minSalePrice, 0, ',', '.') }} -
                                        ₫{{ number_format($maxSalePrice, 0, ',', '.') }}</span>
                                @else
                                    <span class="new-price">₫{{ number_format($minRegularPrice, 0, ',', '.') }} -
                                        ₫{{ number_format($maxRegularPrice, 0, ',', '.') }}</span>
                                @endif
                            </div>

                            <p class="content-paragraph">{!! $product->short_description !!}</p>
                            <hr>
                            <div class="product-availability">
                                <span>Có sẵn : </span>
                                <span class="inner-text">{{ $product->variants()->sum('stock_quantity') }} Sản phẩm có
                                    sẵn</span>
                            </div>
                            @foreach ($attributes as $attribute)
                                <div class="product-size">
                                    <p class="size-title">{{ ucfirst($attribute['name']) }}</p>
                                    <div class="product-attributes">
                                        <div class="attribute-options">
                                            @foreach ($attribute['values'] as $id => $value)
                                                <label class="attribute-option"
                                                    for="atttributeValue[{{ $attribute['id'] }}][{{ $id }}]">
                                                    <input type="radio"
                                                        id="atttributeValue[{{ $attribute['id'] }}][{{ $id }}]"
                                                        name="atttributeValue[{{ $attribute['id'] }}]"
                                                        value="{{ $attribute['id'] }}-{{ $id }}" />
                                                    <span class="attribute-name">{{ $value }}</span>
                                                </label>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <form action="{{ route('add.cart') }}" method="post" onclick="return addToCart()">
                                @csrf
                                <div class="product-quantity">
                                    <div class="quantity-wrapper">
                                        <div class="quantity">
                                            <span class="minus">
                                                -
                                            </span>
                                            <input type="text" class="number" id="quantity" value="1"
                                                name="quantity">
                                            <span class="plus">
                                                +
                                            </span>
                                        </div>
                                        <div class="wishlist favourite cart-item" data-product-id="{{ $product->id }}">
                                            <span>
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M17 1C14.9 1 13.1 2.1 12 3.7C10.9 2.1 9.1 1 7 1C3.7 1 1 3.7 1 7C1 13 12 22 12 22C12 22 23 13 23 7C23 3.7 20.3 1 17 1Z"
                                                        stroke="#797979" stroke-width="2" stroke-miterlimit="10"
                                                        stroke-linecap="square" />
                                                </svg>
                                            </span>
                                        </div>
                                    </div>


                                    <div class="shop-btn" id="add-to-cart">
                                        <span>
                                            <svg width="14" height="14" viewBox="0 0 14 14" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M8.25357 3.32575C8.25357 4.00929 8.25193 4.69283 8.25467 5.37583C8.25576 5.68424 8.31536 5.74439 8.62431 5.74439C9.964 5.74603 11.3031 5.74275 12.6428 5.74603C13.2728 5.74767 13.7397 6.05663 13.9246 6.58104C14.2209 7.42098 13.614 8.24232 12.6762 8.25052C11.5919 8.25982 10.5075 8.25271 9.4232 8.25271C9.17714 8.25271 8.93107 8.25216 8.68501 8.25271C8.2913 8.2538 8.25412 8.29154 8.25412 8.69838C8.25357 10.0195 8.25686 11.3412 8.25248 12.6624C8.25029 13.2836 7.92603 13.7544 7.39891 13.9305C6.56448 14.2088 5.75848 13.6062 5.74863 12.6821C5.73824 11.7251 5.74645 10.7687 5.7459 9.81173C5.7459 9.41965 5.74754 9.02812 5.74535 8.63604C5.74371 8.30849 5.69012 8.2538 5.36204 8.25326C4.02235 8.25162 2.68321 8.25545 1.34352 8.25107C0.719613 8.24943 0.249902 7.93008 0.0710952 7.40348C-0.212153 6.57065 0.388245 5.75916 1.31017 5.74658C2.14843 5.73564 2.98669 5.74384 3.82495 5.74384C4.30779 5.74384 4.79062 5.74384 5.274 5.74384C5.72184 5.7433 5.7459 5.71869 5.7459 5.25716C5.7459 3.95406 5.74317 2.65096 5.74699 1.34786C5.74863 0.720643 6.0625 0.253102 6.58799 0.0704598C7.40875 -0.213893 8.21803 0.370671 8.25248 1.27349C8.25303 1.29154 8.25303 1.31013 8.25303 1.32817C8.25357 1.99531 8.25357 2.66026 8.25357 3.32575Z"
                                                    fill="white" />
                                            </svg>
                                        </span>
                                        <input type="hidden" name="stock-quantity" id="stock-quantity">
                                        <input type="hidden" name="product-variant-id" id="product-variant-id">
                                        <button type="submit">Thêm vào giỏ hàng</button>
                                    </div>

                                </div>
                            </form>
                            <hr>
                            <div class="product-details">
                                <p class="category">Danh mục : <span
                                        class="inner-text">{{ $product->category->name }}</span></p>
                                <p class="sku">SKU : <span class="inner-text">{{ $product->sku }}</span></p>
                            </div>
                            <hr>
                            
                            <div class="product-share">
                                <p>Share This:</p>
                                <div class="social-icons">
                                    <a href="https://www.facebook.com/" onclick="shareOnFacebook()"  target="_blank">
                                        <span class="facebook">
                                            <svg width="10" height="16" viewBox="0 0 10 16" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M3 16V9H0V6H3V4C3 1.3 4.7 0 7.1 0C8.3 0 9.2 0.1 9.5 0.1V2.9H7.8C6.5 2.9 6.2 3.5 6.2 4.4V6H10L9 9H6.3V16H3Z"
                                                    fill="#3E75B2" />
                                            </svg>
                                        </span>
                                    </a>
                                    </a>
                                    <a href="https://twitter.com/" onclick="shareOnTwitter()" target="_blank">
                                        <span class="twitter">
                                            <svg width="18" height="14" viewBox="0 0 18 14" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M17.0722 1.60052C16.432 1.88505 15.7562 2.06289 15.0448 2.16959C15.7562 1.74278 16.3253 1.06701 16.5742 0.248969C15.8985 0.640206 15.1515 0.924742 14.3335 1.10258C13.6933 0.426804 12.7686 0 11.7727 0C9.85206 0 8.28711 1.56495 8.28711 3.48557C8.28711 3.7701 8.32268 4.01907 8.39382 4.26804C5.51289 4.12577 2.9165 2.73866 1.17371 0.604639C0.889175 1.13814 0.71134 1.70722 0.71134 2.34742C0.71134 3.5567 1.31598 4.62371 2.27629 5.26392C1.70722 5.22835 1.17371 5.08608 0.675773 4.83711V4.87268C0.675773 6.5799 1.88505 8.00258 3.48557 8.32268C3.20103 8.39382 2.88093 8.42938 2.56082 8.42938C2.34742 8.42938 2.09845 8.39382 1.88505 8.35825C2.34742 9.74536 3.62784 10.7768 5.15722 10.7768C3.94794 11.7015 2.45412 12.2706 0.818041 12.2706C0.533505 12.2706 0.248969 12.2706 0 12.2351C1.56495 13.2309 3.37887 13.8 5.37062 13.8C11.8082 13.8 15.3294 8.46495 15.3294 3.84124C15.3294 3.69897 15.3294 3.52113 15.3294 3.37887C16.0052 2.9165 16.6098 2.31186 17.0722 1.60052Z"
                                                    fill="#3FD1FF" />
                                            </svg>
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="product product-description">
        <div class="container">
            <div class="product-detail-section">
                <nav>
                    <div class="nav nav-tabs nav-item" id="nav-tab" role="tablist">
                        <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab"
                            data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home"
                            aria-selected="true">Mô tả
                        </button>
                        <button class="nav-link" id="nav-review-tab" data-bs-toggle="tab" data-bs-target="#nav-review"
                            type="button" role="tab" aria-controls="nav-review" aria-selected="false">Đánh giá
                        </button>
                        <button class="nav-link" id="nav-seller-tab" data-bs-toggle="tab" data-bs-target="#nav-seller"
                            type="button" role="tab" aria-controls="nav-seller" aria-selected="false">Thông tin của
                            hàng
                        </button>
                    </div>
                </nav>
                <div class="tab-content tab-item" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab"
                        tabindex="0" data-aos="fade-up">
                        <div class="product-intro-section">
                            {!! $product->content !!}
                        </div>

                    </div>
                    <div class="tab-pane fade" id="nav-review" role="tabpanel" aria-labelledby="nav-review-tab"
                        tabindex="0">
                        <div class="product-review-section" data-aos="fade-up">
                            <h5 class="intro-heading">Reviews</h5>
                            <div class="review-wrapper">
                                @if (isset($reviews[0]))
                                    @foreach ($reviews[0] as $review)
                                        <x-comment :review="$review" :reviews="$reviews" />
                                    @endforeach
                                @else
                                    <p>Không có đánh giá nào</p>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-seller" role="tabpanel" aria-labelledby="nav-seller-tab"
                    tabindex="0">
                    <div class="seller-info-section" >
                        <div class="logo">
                            <img src="{{ $product->seller->logo_shop ? \Storage::url($product->seller->logo_shop) : asset('theme/client/assets/images/logos/avatar.jpg') }}" alt="">
                        </div>
                        <div class="desc">
                            <div class="name-shop">{{ $product->seller->store_name }}</div>
                            <div class="action">
                                <a id="chat-seller" data-seller-id="{{ $product->seller->id }}"><i class="fab fa-rocketchat"></i>Chat ngay</a>
                                <a href="#"><i class="fas fa-store"></i>Xem shop</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="product weekly-sale product-weekly footer-padding">
        <div class="container">
            <div class="section-title">
                <h5>Có thể bạn cũng thích</h5>
                <a href="{{ route('home.shop')}}" class="view">View All</a>
            </div>
            <div class="weekly-sale-section">
                <div class="row g-5">
                    @foreach ($productrelated as $item)
                    @include('client.components.product', [
                        'class' => 'col-lg-3 col-md-6',
                        'product' => $item,
                    ])
                    @endforeach
                    
                    
                </div>
            </div>
        </div>
    </section>

    @if(auth()->check())
        <div class="w-50 chat-position-fixed">
        <div class="col-md-8 col-xl-6 chat">
            <div class="card">
                <div class="card-header msg_head">
                    <div class="d-flex bd-highlight">
                        <div class="img_cont">
                            <img src="{{ $product->seller->logo_shop ? \Storage::url($product->seller->logo_shop) : asset('theme/client/assets/images/logos/avatar.jpg') }}" class="rounded-circle user_img">
                            <span class="online_icon"></span>
                        </div>
                        <div class="user_info">
                            <span>{{ $product->seller->store_name }}</span>
                        </div>
                    </div>
                    <span id="action_menu_btn"><i class="fa-solid fa-xmark"></i></span>

                </div>
                <div class="card-body msg_card_body">

                    <div class="d-flex justify-content-start mb-4">
                        <div class="img_cont_msg">
                            <img src="https://static.turbosquid.com/Preview/001292/481/WV/_D.jpg" class="rounded-circle user_img_msg">
                        </div>
                        <div class="msg_cotainer">
                            Hi, how are you samim?
                            <span class="msg_time">8:40 AM, Today</span>
                        </div>
                    </div>

                </div>
                <div class="card-footer">
                    <div class="input-group">
                        <div class="input-group-append">
                            <span class="input-group-text attach_btn"><i class="fas fa-paperclip"></i></span>
                        </div>
                        <input name="" class="form-control type_msg" id="chat-message" autocomplete="off" placeholder="Type your message...">
                        <div class="input-group-append" >
                            <span class="input-group-text send_btn p-4" id="send_btn"><i class="fas fa-location-arrow"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
@endsection
@section('css')
    <style>
        .chat-position-fixed{
            display: none;
            position: fixed;
            bottom: 8%;
            z-index: 888;
            right: -300px;
        }
        .chat-position-fixed {
            .chat {
                margin-top: auto;
                margin-bottom: auto;
            }

            .card {
                height: 500px;
                border-radius: 15px !important;
                background-color: #FFFFFF !important;
            }

            .contacts_body {
                padding: 0.75rem 0 !important;
                overflow-y: auto;
                white-space: nowrap;
            }

            .msg_card_body {
                overflow-y: auto;
            }

            .card-header {
                border-radius: 15px 15px 0 0 !important;
                border-bottom: 0 !important;
            }

            .card-footer {
                border-radius: 0 0 15px 15px !important;
                border-top: 0 !important;
            }

            .container {
                align-content: center;
            }

            .search {
                border-radius: 15px 0 0 15px !important;
                background-color: rgba(0, 0, 0, 0.3) !important;
                border: 0 !important;
                color: white !important;
            }

            .search:focus {
                box-shadow: none !important;
                outline: 0px !important;
            }

            .type_msg {
                background-color: rgba(0, 0, 0, 0.3) !important;
                border: 0 !important;
                color: white !important;
                margin-top: 0;
                overflow-y: auto;
            }

            .type_msg:focus {
                box-shadow: none !important;
                outline: 0px !important;
            }

            .attach_btn {
                border-radius: 10px 0 0 10px !important;
                background-color: rgba(0, 0, 0, 0.3) !important;
                border: 0 !important;
                color: white !important;
                cursor: pointer;
                height: 100%;
            }

            .send_btn {
                border-radius: 0 10px 10px 0 !important;
                background-color: rgba(0, 0, 0, 0.3) !important;
                border: 0 !important;
                color: white !important;
                cursor: pointer;
                height: 100%;
            }

            .search_btn {
                border-radius: 0 15px 15px 0 !important;
                background-color: rgba(0, 0, 0, 0.3) !important;
                border: 0 !important;
                color: white !important;
                cursor: pointer;
            }

            .contacts {
                list-style: none;
                padding: 0;
            }

            .contacts li {
                width: 100% !important;
                padding: 5px 10px;
                margin-bottom: 15px !important;
            }

            .active {
                background-color: rgba(0, 0, 0, 0.3);
            }

            .user_img {
                height: 70px;
                width: 70px;
                border: 1.5px solid #f5f6fa;

            }

            .user_img_msg {
                height: 40px;
                width: 40px;
                border: 1.5px solid #f5f6fa;

            }

            .img_cont {
                position: relative;
                height: 70px;
                width: 70px;
            }

            .img_cont_msg {
                height: 40px;
                width: 40px;
            }

            .online_icon {
                position: absolute;
                height: 15px;
                width: 15px;
                background-color: #4cd137;
                border-radius: 50%;
                bottom: 0.2em;
                right: 0.4em;
                border: 1.5px solid white;
            }

            .offline {
                background-color: #c23616 !important;
            }

            .user_info {
                margin-top: auto;
                margin-bottom: auto;
                margin-left: 15px;
            }

            .user_info span {
                font-size: 20px;
                color: #000000;
            }

            .user_info p {
                font-size: 10px;
                color: #000000;
            }

            .video_cam {
                margin-left: 50px;
                margin-top: 5px;
            }

            .video_cam span {
                color: #000000;
                font-size: 20px;
                cursor: pointer;
                margin-right: 20px;
            }

            .msg_cotainer {
                margin-top: auto;
                margin-bottom: auto;
                margin-left: 10px;
                border-radius: 10px;
                background-color: #82ccdd;
                padding: 10px;
                position: relative;
                min-width: 75px;
                max-width: 240px;
            }

            .msg_cotainer_send {
                margin-top: auto;
                margin-bottom: auto;
                margin-right: 10px;
                border-radius: 25px;
                background-color: #78e08f;
                padding: 10px;
                position: relative;
            }

            .msg_time {
                position: absolute;
                left: 0;
                bottom: -15px;
                color: #000000;
                font-size: 10px;
            }

            .msg_time_send {
                position: absolute;
                right: 0;
                bottom: -15px;
                color: #000000;
                font-size: 10px;
            }

            .msg_head {
                position: relative;
            }

            #action_menu_btn {
                position: absolute;
                right: 10px;
                top: 10px;
                color: #000000;
                cursor: pointer;
                font-size: 20px;
            }

            .action_menu {
                z-index: 1;
                position: absolute;
                padding: 15px 0;
                background-color: rgba(0, 0, 0, 0.5);
                color: #000000;
                border-radius: 15px;
                top: 30px;
                right: 15px;
                display: none;
            }

            .action_menu ul {
                list-style: none;
                padding: 0;
                margin: 0;
            }

            .action_menu ul li {
                width: 100%;
                padding: 10px 15px;
                margin-bottom: 5px;
            }

            .action_menu ul li i {
                padding-right: 10px;

            }

            .action_menu ul li:hover {
                cursor: pointer;
                background-color: rgba(0, 0, 0, 0.2);
            }

            @media (max-width: 576px) {
                .contacts_card {
                    margin-bottom: 15px !important;
                }
            }

        }
    </style>
@endsection
@section('js')
    <script>
        const attributes = @json($attributes);
        const productId = {{ $product->id }};
        const csrf_token = '{{ csrf_token() }}';
        @if(auth()->check())
            const userReceiver = {{ $product->seller->user_id }};
            const userSend = {{ auth()->id() }};
            const routeLinkChat = '{{ route('messagePrivate', $product->seller->user_id) }}';
            const routeListMessage = '{{ route('listMessagePrivate') }}'
        @endif
    </script>
    @vite(['resources/js/client/product-detail.js', 'resources/js/client/chat-seller.js'])
    <script>
        function shareOnFacebook() {
            const postUrl = encodeURIComponent(window.location.href);
            const facebookUrl = `https://www.facebook.com/sharer/sharer.php?u=${postUrl}`;
            window.open(facebookUrl, '_blank', 'width=600,height=400');
        }
        function shareOnTwitter() {
            const postUrl = encodeURIComponent(window.location.href); // URL hiện tại của bài viết
            const postTitle = encodeURIComponent("Xem bài viết này!"); // Tiêu đề bài viết
            const twitterUrl = `https://twitter.com/intent/tweet?url=${postUrl}&text=${postTitle}`;

            // Mở cửa sổ mới với kích thước xác định
            window.open(twitterUrl, 'shareWindow', 'width=600,height=400,top=100,left=100');
        }
    </script>
@endsection
