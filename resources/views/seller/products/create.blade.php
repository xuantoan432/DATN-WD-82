@extends('seller.layouts.master')
@section('content')
    <div class="main-content">
        <!--breadcrumb-->
        @include('seller.components.breadcrumb', [
            'name' => ' Thêm Sản Phẩm',
            'link' => 'seller.products.index',
            'detail' => 'Sản Phẩm',
        ])
        <!--end breadcrumb-->
        <div class="row">
            <div class="col-12 col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-4">
                            <h6 class="mb-3">Tên Sản Phẩm </h6>
                            <input type="text" class="form-control" placeholder="nhận tên sản phẩm . . . ">
                        </div>
                        <div class="mb-4">
                            <h6 class="mb-3">Ảnh Sản Phẩm Chính </h6>
                            <input id="" class="form-control" type="file" name="">
                        </div>
                        <div class="mb-4">
                            <h6 class="mb-3">Mô tả ngắn : </h6>
                            <textarea class="form-control" id="content" cols="" rows="" placeholder="nội dung. . .  "></textarea>
                        </div>
                        <div class="mb-4">
                            <h6 class="mb-3">Nội Dung </h6>
                            <textarea class="form-control" id='content1' cols="2" rows="3" placeholder="nội dung chính . . .  "></textarea>
                        </div>


                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4">

                <div class="card">
                    <div class="card-body">

                        <div class="row g-3">
                            <div class="col-12">
                                <label for="AddCategory" class="form-label">Danh mục </label>
                                <select class="form-select" id="AddCategory">
                                    <option value="0">Topwear</option>
                                    <option value="1">Bottomwear</option>
                                    <option value="2">Casual Tshirt</option>
                                    <option value="3">Electronic</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label for="Collection" class="form-label">Mã Sản Phẩm </label>
                                <input type="text" class="form-control" id="Collection" placeholder="SKU_">
                            </div>
                            <div class="col-12">
                                <label for="Tags" class="form-label">Giá Sản Phẩm </label>
                                <input type="text" class="form-control" id="Tags" placeholder="200.000">

                            </div>
                            <hr>
                            <div class="d-flex justify-content-between"> <span>Tiền Chiết Khấu : </span> <span> 123.123 đ
                                </span> </div>

                        </div><!--end row-->
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <h5 class="mb-3">Biến Thể Sản Phẩm </h5>
                        <div class="row g-3">
                            <div class="col-12">
                                <select class="form-select" id="multiple-select-clear-field" data-placeholder="Choose anything" multiple>
									<option>Toản</option>
									<option>Tâm</option>
									<option>Jamaica</option>
									<option>Kenya</option>
								</select>
                            </div>
                            <div class="col-12">
                                <div class="d-grid">
                                    <button type="button" id="add-item-btn" class="btn btn-primary" >Thêm biến thể </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">

                        <div class="row g-3">
                            <div class="col-12">
                                <label for="AddCategory" class="form-label">Danh mục </label>
                                <select class="form-select" id="AddCategory">
                                    <option value="0">Topwear</option>
                                    <option value="1">Bottomwear</option>
                                    <option value="2">Casual Tshirt</option>
                                    <option value="3">Electronic</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label for="Collection" class="form-label">Mã Sản Phẩm </label>
                                <input type="text" class="form-control" id="Collection" placeholder="SKU_">
                            </div>
                            <div class="col-12">
                                <label for="Tags" class="form-label">Giá Sản Phẩm </label>
                                <input type="text" class="form-control" id="Tags" placeholder="200.000">

                            </div>
                            <hr>
                            <div class="">
                                <button type="button" class="btn btn-success px-4 raised d-flex gap-2"><i
                                        class="material-icons-outlined">account_circle</i>Đăng sản phẩm </button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div id="repeater">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <h5 class="mb-0">Biến thể sản phẩm </h5>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!--end row-->
    </div>
@endsection
@section('css_new')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
@section('js_new')
    <script src="https://cdn.ckeditor.com/4.22.1/full/ckeditor.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endsection
@vite('/resources/js/seller/product.js')
