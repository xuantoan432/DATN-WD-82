@extends('admin.layouts.master')

@section('content')
    <div class="main-content">

        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Admin</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item active" aria-current="page">Tạo mới Voucher</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row">
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold">Thêm Voucher</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <div class="col-12">
                                <form action="{{ route('admin.vouchers.store') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="user_id" class="form-label">User ID</label>
                                        <input type="text" name="user_id" class="form-control @error('user_id') is-invalid @enderror" placeholder="Nhập User ID" required>
                                        @error('user_id')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="code" class="form-label">Mã Voucher</label>
                                        <input type="text" name="code" class="form-control @error('code') is-invalid @enderror" placeholder="Nhập mã voucher" required>
                                        @error('code')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="discount_type" class="form-label">Loại Giảm Giá</label>
                                        <select class="form-select" id="discount_type" name="discount_type" required>
                                            <option value="percentage">Phần trăm</option>
                                            <option value="fixed">Cố định</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="discount_value" class="form-label">Giá Trị Giảm Giá</label>
                                        <input type="number" step="0.01" class="form-control" id="discount_value" name="discount_value" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="max_discount_amount" class="form-label">Số Tiền Giảm Tối Đa</label>
                                        <input type="number" step="0.01" class="form-control" id="max_discount_amount" name="max_discount_amount" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="min_order_value" class="form-label">Giá Đơn Tối Thiểu</label>
                                        <input type="number" step="0.01" class="form-control" id="min_order_value" name="min_order_value" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="start_date" class="form-label">Ngày Bắt Đầu</label>
                                        <input type="datetime-local" class="form-control" id="start_date" name="start_date" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="end_date" class="form-label">Ngày Kết Thúc</label>
                                        <input type="datetime-local" class="form-control" id="end_date" name="end_date" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="usage_limit" class="form-label">Giới Hạn Sử Dụng</label>
                                        <input type="number" class="form-control" id="usage_limit" name="usage_limit" min="1" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="usage_type" class="form-label">Loại Sử Dụng</label>
                                        <select class="form-select" id="usage_type" name="usage_type" required>
                                            <option value="1">Có</option>
                                            <option value="0">Không</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="usage_per_customer" class="form-label">Giới Hạn Sử Dụng Từng Khách Hàng</label>
                                        <input type="number" class="form-control" id="usage_per_customer" name="usage_per_customer" min="1" required>
                                    </div>
                                    <div>
                                        <button type="submit" class="btn btn-grd-primary px-4">Tạo</button>
                                        <button type="reset" class="btn btn-grd-royal px-4">Reset</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection

@section('css_new')
    <link href="{{ asset('theme/admin/assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet"/>
@endsection

@section('js_new')
    <script src="{{ asset('theme/admin/assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('theme/admin/assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#example').DataTable({
                "aaSorting": [[ 0, "desc" ]] // Sắp xếp theo ID
            });
        });
    </script>
@endsection
