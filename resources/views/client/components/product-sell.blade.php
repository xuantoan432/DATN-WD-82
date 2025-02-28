@php
    $product->load([
                'variants.attributes.attribute',
                'category',
                'reviews',
                'galleries',
                'seller'
            ]);
    $priceSales = [];
    $priceRegulars = [];

    foreach ($product->variants as $variant) {
        $imageVariants[] = $variant->image;
        $priceRegulars[] = $variant->price;
        if (!empty($variant->price_sale)) {
            $priceSales[] = $variant->price_sale;
        }
    }
    $averageRating = $product->reviews->avg('star');
@endphp
<div class="col-lg-4 col-md-6">
    <div class="product-wrapper" data-aos="fade-right">
        <div class="product-img">
            <img src="{{ \Storage::url($product->image) }}" alt="product-img">
            <div class="product-cart-items">
                <a href="" class="favourite cart-item" data-product-id="{{ $product->id }}">
                    <span>
                                                <svg width="40" height="40" viewBox="0 0 40 40" fill="none"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <rect width="40" height="40" rx="20" fill="#AE1C9A" />
                                                    <path
                                                        d="M14.6928 12.3935C13.5057 12.54 12.512 13.0197 11.671 13.8546C10.9155 14.6016 10.4615 15.3926 10.201 16.4216C9.73957 18.2049 10.0745 19.9626 11.1835 21.6141C11.8943 22.6723 12.8135 23.6427 14.4993 25.1221C15.571 26.0632 18.8422 28.8096 19.0022 28.9011C19.1511 28.989 19.2069 29 19.5232 29C19.8395 29 19.8953 28.989 20.0442 28.9011C20.2042 28.8096 23.4828 26.0595 24.5471 25.1221C26.2404 23.6354 27.1521 22.6687 27.8629 21.6141C28.9719 19.9626 29.3068 18.2049 28.8454 16.4216C28.5849 15.3926 28.1309 14.6016 27.3754 13.8546C26.6237 13.1113 25.8199 12.6828 24.7667 12.4631C24.2383 12.3533 23.2632 12.3423 22.8018 12.4448C21.5142 12.7194 20.528 13.3529 19.6274 14.4808L19.5232 14.609L19.4227 14.4808C18.5333 13.3749 17.562 12.7414 16.3228 12.4631C15.9544 12.3789 15.1059 12.3423 14.6928 12.3935ZM15.9357 13.5104C16.9926 13.6935 17.9044 14.294 18.6263 15.2864C18.7491 15.4585 18.9017 15.6636 18.9613 15.7478C19.2367 16.1286 19.8098 16.1286 20.0851 15.7478C20.1447 15.6636 20.2973 15.4585 20.4201 15.2864C21.4062 13.9315 22.7795 13.2944 24.2755 13.4958C25.9352 13.7191 27.2303 14.8616 27.7252 16.5424C28.116 17.8717 27.9448 19.2668 27.234 20.5228C26.6386 21.5738 25.645 22.676 23.9145 24.203C23.0772 24.939 19.5567 27.9198 19.5232 27.9198C19.486 27.9198 15.9804 24.95 15.1319 24.203C12.4711 21.8557 11.4217 20.391 11.1686 18.6736C11.0049 17.5641 11.2393 16.3703 11.8087 15.4292C12.6646 14.0121 14.3318 13.2358 15.9357 13.5104Z"
                                                        fill="#000" />
                                                </svg>
                                            </span>
                </a>
            </div>
        </div>
        <div class="product-info">
            <div class="ratings">
                @php
                    $fullStars = floor($averageRating);
                    $halfStar = $averageRating - $fullStars >= 0.5 ? 1 : 0;

                @endphp
                @for ($i = 0; $i < 5; $i++)
                    @if ($i < $fullStars)
                        <i class="fa-solid fa-star"></i>
                    @elseif ($i == $fullStars && $halfStar)
                        <i class="fa-solid fa-star-half-stroke"></i>
                    @else
                        <i class="fa-regular fa-star"></i>
                    @endif
                @endfor
            </div>
            <div class="product-description">
                <a href="{{ route('home.product-detail', $product->id) }}" class="product-details">{{ $product->name }}
                </a>
                <div class="price flex-column align-items-start ">
                    @php
                        $minRegularPrice = !empty($priceRegulars) ? min($priceRegulars) : null;
                        $maxRegularPrice = !empty($priceRegulars) ? max($priceRegulars) : null;

                        // Nếu cần, xử lý trường hợp không có giá trị
                        if ($minRegularPrice === null || $maxRegularPrice === null) {
                            // Gán giá trị mặc định hoặc thông báo lỗi
                            $minRegularPrice = 0;
                            $maxRegularPrice = 0;
                        }
                    @endphp

                    @if (!empty($priceSales))
                        @php
                            $minSalePrice = min($priceSales);
                            $maxSalePrice = max($priceSales);
                        @endphp
                        <span class="price-cut mt-2">{{ number_format($minRegularPrice, 0, ',', '.') }}₫ -
                                        {{ number_format($maxRegularPrice, 0, ',', '.') }}₫</span>
                        <span class="new-price">{{ number_format($minSalePrice, 0, ',', '.') }}₫ -
                                        {{ number_format($maxSalePrice, 0, ',', '.') }}₫</span>
                    @else
                        <span class="new-price">{{ number_format($minRegularPrice, 0, ',', '.') }}₫ -
                                        {{ number_format($maxRegularPrice, 0, ',', '.') }}₫</span>
                    @endif
                </div>
            </div>
        </div>
        <div class="product-cart-btn">
            <a href="{{ route('home.product-detail', $product->id) }}" class="product-btn">Xem chi tiết</a>
        </div>
    </div>
</div>
