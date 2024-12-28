@extends('client.profile.layout')
@section('main-content')
    <div class="cart-section" id="order-detail1">
        @foreach($orderDetails as $product)
            @php
                $showCancelButton = true;
                $showReviewButton = false;
                $badgeClass = '';
                $statusText = '';
                switch ($product->status) {
                    case 'Pending':
                        $badgeClass = 'bg-warning';
                        $statusText = 'Đang chờ xử lý';
                        break;

                    case 'Processing':
                        $badgeClass = 'bg-info';
                        $statusText = 'Đang xử lý';
                        break;
                    case 'Shipping':
                        $badgeClass = 'bg-info';
                        $statusText = 'Đang giao';
                        $showCancelButton = false;
                        break;
                    case 'Completed':
                        $badgeClass = 'bg-success';
                        $statusText = 'Hoàn thành';
                        $showCancelButton = false;
                        $showReviewButton = true;
                        break;

                    case 'Cancelled':
                        $badgeClass = 'bg-danger';
                        $statusText = 'Đã hủy';
                        $showCancelButton = false;
                        break;

                    default:
                        $badgeClass = 'bg-secondary';
                        $statusText = 'Không xác định';
                        break;
                }
            @endphp
            <div class="order-container">
                <div class="order-header">
                    <div class="order-header-title"></div>
                    <div class="order-status"></div>
                </div>
                <div class="order-item">
                    <a href="{{ route('home.product-detail', $product->productVariant->product->id) }}"><img src="{{ \Storage::url($product->image) }}" alt="Product Image"></a>
                    <div class="order-item-details">
                        <h4 class="order-item-title"><a href="{{ route('home.product-detail', $product->productVariant->product->id) }}">{{ $product->name }}</a></h4>
                        <p class="order-item-info">Phân loại hàng: {{ $product->variant_name }}</p>
                        <p class="order-item-info">Số lượng: x {{ $product->quantity }}</p>
                        <p class="order-item-info">Trạng thái đơn hàng: <span
                                class="badge {{ $badgeClass }}">{{ $statusText }}</span></p>
                    </div>
                    <div class="order-price">
                        {{ number_format($product->price, 0, ',', '.') }} đ
                    </div>
                </div>
                <div class="order-actions">
                    @if(($product->productVariant->product->hasUserRated(auth()->id()) && $showReviewButton ) || $product->isCancelled() )
                        <form action="{{ route('add.cart') }}" method="post">
                            @csrf
                            <input type="hidden" name="product-variant-id" value="{{ $product->product_variant_id }}">
                            <input type="hidden" name="quantity" value="{{ $product->quantity }}">
                            <button type="submit" class="order-btn order-btn-review">Mua lại</button>
                        </form>
                    @elseif($showReviewButton)
                        <button class="order-btn order-btn-review" data-bs-toggle="modal" data-bs-target="#rating-product" data-id="{{ $product->productVariant->product->id }}">Đánh Giá</button>
                    @endif
                    <button class="order-btn order-btn-contact">Liên Hệ Người Bán</button>
                    @if($showCancelButton && !$product->isCancelled())
                        <form action="{{ route('orderDetail.cancel', $product->id) }}" method="post">
                            @csrf
                            <button onclick="return confirm('bạn có chắc muốn hủy không ?')" class="order-btn order-btn-cancel">Hủy Đơn</button>
                        </form>
                    @endif
                </div>

            </div>
        @endforeach
    </div>

    <!-- Modal -->
    <div class="modal fade" id="rating-product" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('rating', $user) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="product_id" id="product_id" value="3">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Đánh giá sản phẩm</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <select class="star-rating" name="star">
                                <option value=""> </option>
                                <option value="5">Tuyệt vời</option>
                                <option value="4">Rất tốt</option>
                                <option value="3">Trung bình</option>
                                <option value="2">Kém</option>
                                <option value="1">Tồi tệ</option>
                            </select>
                            <div class="img-upload-section">
                                <div class="logo-wrapper">
                                    <p class="comment-title mt-3">Tải file</p>
                                    <div class="logo-upload">
                                        <img src="{{ asset('theme/client/assets/images/homepage-one/images.png') }}" alt="upload"
                                             class="upload-img" id="upload-img">
                                        <div class="upload-input">
                                            <label for="input-file">
                                        <span>
                                            <svg width="32" height="32"
                                                 viewBox="0 0 32 32" fill="none"
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
                                            <input type="file" name="image"
                                                   accept="image/jpeg, image/jpg, image/png, image/webp"
                                                   id="input-file">
                                            @error('avatar')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <p class="comment-title mt-3">Nội dung</p>
                                <textarea name="content" id="content" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="order-btn order-btn-contact" data-bs-dismiss="modal">Quay lại</button>
                        <button type="submit" class="order-btn order-btn-review">Đánh giá</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/star-rating.js/dist/star-rating.min.css">
    <style>
        .order-container {
            max-width: 900px;
            margin: 20px auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .order-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .order-header-title {
            font-weight: bold;
            font-size: 18px;
            color: #ae1c9a;
        }

        .order-status {
            color: green;
            font-size: 14px;
            font-weight: bold;
        }

        .order-item {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
        }

        .order-item img {
            width: 120px;
            height: auto;
            border-radius: 5px;
        }

        .order-item-details {
            flex: 1;
        }

        .order-item-title {
            font-size: 16px;
            margin: 0;
            margin-bottom: 8px;
        }

        .order-item-info {
            font-size: 14px;
            margin: 4px 0;
            color: #666;
        }

        .order-price {
            text-align: right;
            font-size: 16px;
            font-weight: bold;
            color: #ae1c9a;
        }

        .order-original-price {
            text-decoration: line-through;
            font-size: 14px;
            color: #aaa;
            margin-right: 5px;
        }

        .order-actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        .order-btn {
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            font-size: 14px;
            cursor: pointer;
        }

        .order-btn-review {
            background-color: #ae1c9a;
            color: #fff;
        }

        .order-btn-cancel {
            background-color: #ff5722;
            color: #fff;
        }

        .order-btn-contact {
            background-color: #f5f5f5;
            border: 1px solid #ccc;
            color: #666;
        }

        .rating-emoji {
            font-size: 30px; /* Kích thước icon */
            font-family: Arial, sans-serif;
        }

        .img-upload-section .logo-wrapper .logo-upload .upload-img{
            width: 6rem;
            height: 5rem;
            margin-top: 0;
            border-radius: unset;
        }

        .img-upload-section .logo-wrapper .logo-upload{
            justify-content: start;
        }
</style>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/star-rating.js/dist/star-rating.min.js"></script>
<script>
    const stars = new StarRating('.star-rating', {
        tooltip: 'Chọn sao',
    });
    stars.rebuild();

    $(".order-btn-review").click(function () {
        const productId = $(this).data("id");

        $("#rating-product").on("shown.bs.modal", function () {
            $(this).find("input[name='product_id']").val(productId);
        });
    });
</script>
@endsection
