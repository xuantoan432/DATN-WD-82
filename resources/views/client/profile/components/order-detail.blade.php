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
                    <img src="{{ \Storage::url($product->image) }}" alt="Product Image">
                    <div class="order-item-details">
                        <h4 class="order-item-title">{{ $product->name }}</h4>
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
                    @if($showReviewButton)
                        <button class="order-btn order-btn-review">Đánh Giá</button>
                    @endif
                    <button class="order-btn order-btn-contact">Liên Hệ Người Bán</button>
                    @if($showCancelButton)
                        <form action="" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="order-btn order-btn-cancel">Hủy Đơn</button>
                        </form>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
@endsection
@section('css')
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
    </style>
@endsection
