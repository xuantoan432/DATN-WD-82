@extends('seller.layouts.master')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Danh sách đơn hàng</h1>
    </div>

    @if ($orders->isNotEmpty())
        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Mã đơn hàng</th>
                        <th>Trạng thái</th>
                        <th>Tổng tiền</th>
                        <th>Ngày tạo</th>
                        <th class="text-center">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $index => $order)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td><a href="{{ route('seller.order.show', $order->id) }}">{{$order->order_code}}</a></td>
                            <td>
                                @if($order->orderStatus->name === 'Pending')
                                    <span class="badge bg-warning">Chờ xác nhận</span>
                                @elseif ($order->orderStatus->name === 'Processing')
                                    <span class="badge bg-success">Đang xử lý</span>
                                @elseif ($order->orderStatus->name === 'Shipped')
                                    <span class="badge bg-info">Đang giao hàng</span>
                                @elseif ($order->orderStatus->name === 'Delivered')
                                    <span class="badge bg-success">Hoàn thành</span>
                                @elseif ($order->orderStatus->name === 'Cancelled')
                                    <span class="badge bg-danger">Đã hủy</span>
                                @endif
                            </td>
                            <td class="text-success">{{ number_format($order->total_price, 0, ',', '.') }} VND</td>
                            <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                            <td class="text-center">
                                <a href="{{ route('seller.order.show', $order->id) }}"
                                    class="btn btn-sm btn-info text-white">Xem</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{$orders->links()}}
        </div>
    @else
        <div class="alert alert-info">
            Chưa có đơn hàng nào được tạo.
        </div>
    @endif
</div>
@endsection