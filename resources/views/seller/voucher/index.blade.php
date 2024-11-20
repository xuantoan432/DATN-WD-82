@extends('seller.layouts.master')

@section('css_new')
    <link href="{{ asset('theme/seller/assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
@endsection

@section('content')
    <div class="main-content">
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Voucher</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item active" aria-current="page">Danh sách Voucher</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <a href="{{ route('seller.vouchers.create') }}" class="btn btn-primary">Tạo Voucher Mới</a>
                        </div>
                        @if (session('success'))
                            <div class="alert bg-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <div class="table-responsive">
                            <table id="vouchersTable" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>User ID</th>
                                        <th>Mã Voucher</th>
                                        <th>Loại Giảm Giá</th>
                                        <th>Giá Trị Giảm Giá</th>
                                        {{-- <th>Số Tiền Giảm Tối Đa</th>
                                        <th>Giá Đơn Tối Thiểu</th> --}}
                                        <th>Ngày Bắt Đầu</th>
                                        <th>Ngày Kết Thúc</th>
                                        <th>Giới Hạn Sử Dụng</th>
                                        <th>Loại Sử Dụng</th>
                                        <th>Giới Hạn Sử Dụng Từng Khách Hàng</th>
                                        <th>Hành Động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($vouchers as $voucher)
                                        <tr>
                                            <td>{{ $voucher->id }}</td>
                                            <td>{{ $voucher->user_id }}</td>
                                            <td>{{ $voucher->code }}</td>
                                            <td>
                                                {{ $voucher->discount_type === 'percentage' ? 'Phần trăm' : ($voucher->discount_type === 'fixed' ? 'Cố định' : 'Không xác định') }}
                                            </td>
                                            <td>{{ number_format($voucher->discount_value, 0) }}</td>
                                            {{-- <td>{{ number_format($voucher->max_discount_amount, 0) }}</td>
                                            <td>{{ number_format($voucher->min_order_value, 0) }}</td> --}}
                                            <td>{{ $voucher->start_date }}</td>
                                            <td>{{ $voucher->end_date }}</td>
                                            <td>{{ $voucher->usage_limit }}</td>
                                            <td>{{ $voucher->usage_type == 1 ? 'Xếp chồng' : 'Không xếp chồng' }}</td>
                                            <td>{{ $voucher->usage_per_customer }}</td>
                                            <td>
                                                <div class="row row-cols-auto g-3 mt-2">
                                                    <div class="col">
                                                        <a href="{{ route('seller.vouchers.edit', $voucher) }}"
                                                           class="btn btn-outline-warning d-flex gap-2">
                                                            <i class="material-icons-outlined">edit</i>
                                                        </a>
                                                    </div>
                                                    <div class="col">
                                                        <form action="{{ route('seller.vouchers.destroy', $voucher) }}"
                                                              method="POST" style="display:inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                    class="btn btn-outline-danger d-flex gap-2"
                                                                    onclick="return confirm('Bạn có chắc chắn muốn xóa không?')">
                                                                <i class="material-icons-outlined">delete</i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
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
@endsection

@section('js_new')
    <script src="{{ asset('theme/seller/assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('theme/seller/assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#vouchersTable').DataTable({
                "aaSorting": [
                    [0, "desc"]
                ] // Sắp xếp theo cột ID
            });
        });
    </script>
@endsection
