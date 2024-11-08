@extends('seller.layouts.master')

@section('content')
    <div class="main-content">
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">seller</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item active" aria-current="page">Sửa Voucher</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold">Sửa Voucher: {{ $voucher->code }}</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('seller.vouchers.update', $voucher->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="code" class="form-label">Mã Voucher</label>
                                <input type="text" name="code" class="form-control @error('code') is-invalid @enderror"
                                       value="{{ old('code', $voucher->code) }}" placeholder="Nhập mã voucher">
                                @error('code')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="discount_type" class="form-label">Loại giảm giá</label>
                                <select name="discount_type" class="form-select @error('discount_type') is-invalid @enderror">
                                    <option value="Phần trăm" {{ old('discount_type', $voucher->discount_type) == 'Phần trăm' ? 'selected' : '' }}>Phần trăm</option>
                                    <option value="Cố định" {{ old('discount_type', $voucher->discount_type) == 'Cố định' ? 'selected' : '' }}>Giá cố định</option>
                                </select>
                                @error('discount_type')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="discount_value" class="form-label">Giá trị giảm giá</label>
                                <input type="number" name="discount_value" class="form-control @error('discount_value') is-invalid @enderror"
                                       value="{{ old('discount_value',number_format($voucher->discount_value, 0)) }}" min="0">
                                @error('discount_value')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="max_discount_amount" class="form-label">Giới hạn giảm giá tối đa</label>
                                <input type="number" name="max_discount_amount" class="form-control @error('max_discount_amount') is-invalid @enderror"
                                       value="{{ old('max_discount_amount', number_format($voucher->max_discount_amount, 0)) }}" min="0">
                                @error('max_discount_amount')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="min_order_value" class="form-label">Giá trị đơn hàng tối thiểu</label>
                                <input type="number" name="min_order_value" class="form-control @error('min_order_value') is-invalid @enderror"
                                       value="{{ old('min_order_value', number_format($voucher->min_order_value, 0)) }}" min="0">
                                @error('min_order_value')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="start_date" class="form-label">Ngày bắt đầu</label>
                                <input type="date" name="start_date" class="form-control @error('start_date') is-invalid @enderror"
                                       value="{{ old('start_date', $voucher->start_date ? $voucher->start_date->format('Y-m-d') : '') }}">
                                @error('start_date')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label for="end_date" class="form-label">Ngày kết thúc</label>
                                <input type="date" name="end_date" class="form-control @error('end_date') is-invalid @enderror"
                                       value="{{ old('end_date', $voucher->end_date ? $voucher->end_date->format('Y-m-d') : '') }}">
                                @error('end_date')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <button type="submit" class="btn btn-primary px-4">Cập nhật</button>
                                <a href="{{ route('seller.vouchers.index') }}" class="btn btn-secondary px-4">Quay lại</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css_new')
    <link href="{{asset('theme/seller/assets/plugins/datatable/css/dataTables.bootstrap5.min.css')}}" rel="stylesheet"/>
@endsection

@section('js_new')
    <script src="{{asset('theme/seller/assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('theme/seller/assets/plugins/datatable/js/dataTables.bootstrap5.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('#example').DataTable({
                "aaSorting": [[ 0, "desc" ]] // Sắp xếp theo cột đầu tiên giảm dần
            });
        });
    </script>
@endsection
