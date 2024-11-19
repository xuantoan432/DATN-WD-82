@extends('seller.layouts.master')

@section('content')
    <div class="main-content">

        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">seller</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item active" aria-current="page">Tạo mới Voucher</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold">Thêm Voucher</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('seller.vouchers.store') }}" method="POST">
                            @csrf

                            {{-- <div class="mb-3">
                                <label for="user_id" class="form-label">User ID</label>
                                <input type="text" name="user_id" class="form-control @error('user_id') is-invalid @enderror" placeholder="" required>
                                @error('user_id')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div> --}}

                            <div class="mb-3">
                                <label for="code" class="form-label">Mã Voucher</label>
                                <input type="text" name="code" class="form-control @error('code') is-invalid @enderror" placeholder="Nhập mã voucher" required>
                                @error('code')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="discount_type" class="form-label">Loại Giảm Giá</label>
                                <select class="form-select @error('discount_type') is-invalid @enderror" id="discount_type" name="discount_type" required>
                                    <option value="percentage">Phần trăm</option>
                                    <option value="fixed">Cố định</option>
                                </select>
                                @error('discount_type')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="discount_value" class="form-label">Giá Trị Giảm Giá</label>
                                <input type="number" step="0.01" class="form-control @error('discount_value') is-invalid @enderror" id="discount_value" name="discount_value" required>
                                @error('discount_value')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="max_discount_amount" class="form-label">Số Tiền Giảm Tối Đa</label>
                                <input type="number" step="0.01" class="form-control @error('max_discount_amount') is-invalid @enderror" id="max_discount_amount" name="max_discount_amount" required>
                                @error('max_discount_amount')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="min_order_value" class="form-label">Giá Đơn Tối Thiểu</label>
                                <input type="number" step="0.01" class="form-control @error('min_order_value') is-invalid @enderror" id="min_order_value" name="min_order_value" required>
                                @error('min_order_value')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="start_date" class="form-label">Ngày Bắt Đầu</label>
                                <input type="datetime-local" class="form-control @error('start_date') is-invalid @enderror" id="start_date" name="start_date" required>
                                @error('start_date')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="end_date" class="form-label">Ngày Kết Thúc</label>
                                <input type="datetime-local" class="form-control @error('end_date') is-invalid @enderror" id="end_date" name="end_date" required>
                                @error('end_date')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="usage_limit" class="form-label">Giới Hạn Sử Dụng</label>
                                <input type="number" class="form-control @error('usage_limit') is-invalid @enderror" id="usage_limit" name="usage_limit" min="1" required>
                                @error('usage_limit')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="usage_type" class="form-label">Loại Sử Dụng</label>
                                <select class="form-select @error('usage_type') is-invalid @enderror" id="usage_type" name="usage_type" required>
                                    <option value="1">Xếp chồng</option>
                                    <option value="0">Không xếp chồng</option>
                                </select>
                                @error('usage_type')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="usage_per_customer" class="form-label">Giới Hạn Sử Dụng Từng Khách Hàng</label>
                                <input type="number" class="form-control @error('usage_per_customer') is-invalid @enderror" id="usage_per_customer" name="usage_per_customer" min="1" required>
                                @error('usage_per_customer')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
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
@endsection


