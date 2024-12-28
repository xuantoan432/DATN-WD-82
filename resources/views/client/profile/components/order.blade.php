@extends('client.profile.layout')
@section('main-content')
    <div class="cart-section" id="order-detail1">
        <table>
            <tbody>
            <tr class="table-row table-top-row">
                <td class="table-wrapper">
                    <div class="table-wrapper-center">
                        <h5 class="table-heading">MÃ ĐƠN HÀNG</h5>
                    </div>
                </td>
                <td class="table-wrapper">
                    <div class="table-wrapper-center">
                        <h5 class="table-heading">TỔNG TIỀN</h5>
                    </div>
                </td>
                <td class="table-wrapper">
                    <div class="table-wrapper-center">
                        <h5 class="table-heading">NGƯỜI NHẬN</h5>
                    </div>
                </td>
                <td class="table-wrapper">
                    <div class="table-wrapper-center">
                        <h5 class="table-heading">ĐỊA CHỈ</h5>
                    </div>
                </td>
                <td class="table-wrapper">
                    <div class="table-wrapper-center">
                        <h5 class="table-heading">TRẠNG THÁI</h5>
                    </div>
                </td>
            </tr>
            @foreach($user->orders()->orderByDesc('id')->get() as $order)
                <tr class="table-row ticket-row">
                    <td class="table-wrapper wrapper-total">
                        <div class="table-wrapper-center">
                            <a href="{{ route('orderDetail', $order->order_code) }}" class="heading order-detail text-decoration-underline" >{{ $order->order_code }}</a>
                        </div>
                    </td>
                    <td class="table-wrapper wrapper-total">
                        <div class="table-wrapper-center">
                            <h5 class="heading">{{ number_format($order->total_price, 0, ',', '.') }} đ</h5>
                        </div>
                    </td>
                    <td class="table-wrapper wrapper-total">
                        <div class="table-wrapper-center">
                            <h5 class="heading">{{ $order->address->details->full_name }}</h5>
                        </div>
                    </td>
                    <td class="table-wrapper wrapper-total">
                        <div class="table-wrapper-center">
                            <h5 class="heading">{{ $order->address->getFullAddress() }}</h5>
                        </div>
                    </td>
                    <td class="table-wrapper wrapper-total">
                        <div class="table-wrapper-center">
                            @php
                                $badgeClass = '';
                                $statusText = '';

                                switch ($order->status) {
                                    case 'Pending':
                                        $badgeClass = 'bg-warning';
                                        $statusText = 'Đang chờ xử lý';
                                        break;

                                    case 'Processing':
                                        $badgeClass = 'bg-info';
                                        $statusText = 'Đang xử lý';
                                        break;

                                    case 'Completed':
                                        $badgeClass = 'bg-success';
                                        $statusText = 'Hoàn thành';
                                        break;

                                    case 'Cancelled':
                                        $badgeClass = 'bg-danger';
                                        $statusText = 'Đã hủy';
                                        break;

                                    default:
                                        $badgeClass = 'bg-secondary';
                                        $statusText = 'Không xác định';
                                        break;
                                }
                            @endphp

                            <span class="badge {{ $badgeClass }}">{{ $statusText }}</span>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection


