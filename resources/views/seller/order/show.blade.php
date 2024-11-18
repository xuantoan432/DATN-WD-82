@extends('seller.layouts.master')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Chi tiết đơn hàng</h4>
            <a href="{{ route('seller.order.index') }}" class="btn btn-light btn-sm">Quay lại</a>
        </div>
        <div class="card-body">
            <h5 class="card-title">Mã đơn hàng: <strong>{{ $order->order_code }}</strong></h5>
            <p><strong>Ngày tạo:</strong> {{ $order->created_at->format('d/m/Y H:i') }}</p>
            <p><strong>Tổng tiền:</strong> <span
                    class="text-success">{{ number_format($order->total_price, 0, ',', '.') }} VND</span></p>
            <p>
                <strong>Trạng thái:</strong>
                @if($order->orderStatus->name === 'Pending')
                    <span class="badge bg-warning">Chờ xác nhận</span>
                @elseif($order->orderStatus->name === 'Processing')
                    <span class="badge bg-success">Đang xử lý</span>
                @elseif($order->orderStatus->name === 'Shipped')
                    <span class="badge bg-info">Đang vận chuyển</span>
                @elseif($order->orderStatus->name === 'Delivered')
                    <span class="badge bg-success">Hoàn thành</span>
                @elseif($order->orderStatus->name === 'Cancelled')
                    <span class="badge bg-danger">Đã hủy</span>
                @endif
            </p>
        </div>
    </div>

    <div class="card mt-4 shadow-sm">
        <div class="card-header bg-secondary text-white">
            <h5 class="mb-0">Chi tiết sản phẩm</h5>

        </div>
        <div class="card-body">
                <table class="table table-bordered">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Sản phẩm</th>
                            <th>Số lượng</th>
                            <th>Đơn giá</th>
                            <th>Tổng</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->orderDetails as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item->productVariant}}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>{{ number_format($item->price, 0, ',', '.') }} VND</td>
                                <td>{{ number_format($item->quantity * $item->price, 0, ',', '.') }} VND</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="4" class="text-end">Tổng cộng:</th>
                            <th>{{ number_format($order->total_price, 0, ',', '.') }} VND</th>
                        </tr>
                    </tfoot>
                </table>
        </div>
    </div>
</div>
@endsection