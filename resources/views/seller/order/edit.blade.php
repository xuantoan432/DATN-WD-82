@extends('seller.layouts.master')

@section('content')
    <div class="main-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Seller</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item active" aria-current="page">Sửa thuộc tính</li>
                    </ol>
                </nav>
            </div>

        </div>
        <!--end breadcrumb-->
        <div class="row">
            <div class="col-8">
                <div class="card">
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="d-flex align-items-center gap-3">
                                <table class="table align-middle" id="bang">
                                    <thead class="table-light mt-3">
                                    <tr>
                                        <th>Sản Phẩm</th>
                                        <th>Giá</th>
                                        <th>Số lượng</th>
                                        <th>Trạng thái</th>
                                        <th>Ngày đặt</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center gap-3">
                                                <div class="product-box">
                                                    <img src="{{ \Storage::url($orderDetail->image) }}"
                                                         width="70" class="rounded-3" alt="">
                                                </div>
                                                <div class="product-info">
                                                    <p class="product-title">
                                                        {{ $orderDetail->name }}
                                                    </p>
                                                    <p class="mb-0 product-category">Biến thể :
                                                        {{ $orderDetail->variant_name }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            {{ number_format($orderDetail->price, 0, ',', '.') . ' VNĐ' }}
                                        </td>
                                        <td class="text-center"> {{ $orderDetail->quantity }} </td>
                                        <td>
                                            @php
                                                $badgeClass = '';
                                                $statusText = '';
                                                switch ($orderDetail->status) {
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
                                        </td>
                                        <td>
                                            {{ $orderDetail->created_at->format('H:i d/m/Y') }}
                                        </td>

                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <a href="{{ route('seller.orders.index') }}" class="btn btn-grd-info">Quay lại</a>
                        @if($orderDetail->status !== \App\Models\OrderDetail::CANCELLED || $orderDetail->status !== \App\Models\OrderDetail::COMPLETED)
                            <button type="button" class="btn btn-grd-primary px-4" data-bs-toggle="modal"
                                    data-bs-target="#BasicModal">Cập nhật trạng thái
                            </button>
                        @endif
                    </div>
                </div>
                <div class="modal fade" id="BasicModal">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header border-bottom-0 py-2">
                                <h5 class="modal-title">Cập nhật trạng thái</h5>
                                <a href="javascript:;" class="primaery-menu-close" data-bs-dismiss="modal">
                                    <i class="material-icons-outlined">close</i>
                                </a>
                            </div>
                            <form action="{{ route('seller.orders.update', $orderDetail) }}" method="post">
                                @csrf
                                @method('PUT')
                                <div class="modal-body">
                                    <select name="status" id="order-status" class="form-control">
                                        @foreach(\App\Models\OrderDetail::getStatuses() as $key => $label)
                                            <option value="{{ $key }}" @selected($key === $orderDetail->status)>{{ $label }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="modal-footer border-top-0">
                                    <button type="button" class="btn btn-grd-danger" data-bs-dismiss="modal">Đóng
                                    </button>
                                    <button type="submit" class="btn btn-grd-info">Cập nhật</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card">
                    <div class="card-body p-4">
                        <div class="card">
                            <div class="card-header">
                                Khách hàng
                            </div>
                            <div class="card-body">
                                <div class="product-info">
                                    <img
                                        src="{{ $orderDetail->order->user->avata ?? asset('theme/client/assets/images/logos/avatar.jpg') }}"
                                        class="rounded-circle p-1 border" width="45" height="45" alt="">
                                    <p class="mb-0 product-category">{{ $orderDetail->order->user->name }}</p>
                                    <a href="tel:{{ $orderDetail->order->user->phone }}"
                                       class="mb-0 product-category">{{ $orderDetail->order->user->phone }}</a>
                                    <a href="mailto:{{ $orderDetail->order->user->email }}"
                                       class="mb-0 product-category">{{ $orderDetail->order->user->email }}</a>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                Thông tin giao hàng
                            </div>
                            <div class="card-body">
                                <div class="product-info">
                                    <p class="mb-0 product-category">Tên người nhận: {{ $user->details->full_name }}</p>
                                    <a href="tel:{{ $user->details->phone_number }}" class="mb-0 product-category"> Số
                                        điện thoại: {{ $user->details->phone_number }}</a>
                                    <p class="mb-0 product-category">Địa chỉ: {{ $user->getFullAddress() }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
@section('css_new')
    <link rel="stylesheet" href="{{ asset('theme/admin/assets/plugins/notifications/css/lobibox.min.css') }}">
@endsection
@section('js_new')
    <script src="{{ asset('theme/admin/assets/plugins/notifications/js/lobibox.min.js') }}"></script>
    <script src="{{ asset('theme/admin/assets/plugins/notifications/js/notifications.min.js') }}"></script>
    <script>
        function thongbao(color, icon, msg) {
            Lobibox.notify(color, {
                pauseDelayOnHover: false,
                icon: icon,
                continueDelayOnInactiveTab: false,
                position: 'top right',
                size: 'mini',
                msg: msg
            });
        }
        @if(session('success'))
            console.log(1)
            thongbao('success', 'bi bi-check-circle', '{{ session('success') }}');
        @endif
        @if(session('error'))
            console.log(2)
            thongbao('error', 'bi bi-exclamation-triangle', '{{ session('error') }}');
        @endif
    </script>
@endsection
