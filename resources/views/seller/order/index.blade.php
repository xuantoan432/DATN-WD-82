@extends('seller.layouts.master')

@section('content')
    <div class="main-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Seller</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item active" aria-current="page">Danh sách đơn hàng</li>
                    </ol>
                </nav>
            </div>

        </div>
        <!--end breadcrumb-->
        <div class="row">
            <div class="col-12">
                <div class="card mt-4">
                    <div class="card-body">
                        <div class="product-table">
                            <div class="table-responsive white-space-nowrap">
                                <table class="table align-middle" id="bang">
                                    <thead class="table-light mt-3">
                                    <tr>
                                        <th>Sản Phẩm </th>
                                        <th>Giá </th>
                                        <th>Số lượng </th>
                                        <th>Trạng thái</th>
                                        <th>Ngày đặt</th>
                                        <th>Hành động </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($orderDetails as $product)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center gap-3">
                                                    <div class="product-box">
                                                        <img src="{{ \Storage::url($product->image) }}"
                                                             width="70" class="rounded-3" alt="">
                                                    </div>
                                                    <div class="product-info">
                                                        <a href="javascript:;" class="product-title">
                                                            {{ $product->name }}
                                                        </a>
                                                        <p class="mb-0 product-category">Biến thể :
                                                            {{ $product->variant_name }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                {{ number_format($product->price, 0, ',', '.') . ' VNĐ' }}
                                            </td>
                                            <td class="text-center"> {{ $product->quantity }} </td>
                                            <td>
                                                @php
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
                                                {{ $product->created_at->format('H:i d/m/Y') }}
                                            </td>
                                            <td>
                                                <a href="{{ route('seller.orders.edit', $product) }}"
                                                   class="btn btn-outline-warning">
                                                    <i class="material-icons-outlined">edit</i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>

@endsection
@section('css_new')
    <link href="{{asset('theme/admin/assets/plugins/datatable/css/dataTables.bootstrap5.min.css')}}" rel="stylesheet"/>
@endsection
@section('js_new')

    <script src="{{asset('theme/admin/assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('theme/admin/assets/plugins/datatable/js/dataTables.bootstrap5.min.js')}}"></script>
    <script>
        $(document).ready(function() {
            $('#bang').DataTable({
                // display everything
                order: false,
                lengthChange: false,
                language: {
                    info: " Từ _START_ đến _END_ trong  _TOTAL_ mục",
                    infoEmpty: "Không có dữ liệu để hiển thị",
                    paginate: {
                        first: "Đầu",
                        last: "Cuối",
                        next: "Tiếp",
                        previous: "Trước"
                    },
                    zeroRecords: "Không tìm thấy dữ liệu",
                    infoFiltered: "(lọc từ _MAX_ mục)",
                    lengthMenu: "Hiển thị _MENU_ mục"
                }
            });
        });
    </script>
@endsection
