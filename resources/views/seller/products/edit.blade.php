@extends('seller.layouts.master')
@section('content')
    <div class="main-content">
        <!--breadcrumb-->
        @include('seller.components.breadcrumb', [
            'name' => 'Sửa  Sản Phẩm',
            'link' => 'seller.products.index',
            'detail' => 'Sản Phẩm',
        ])
        <!--end breadcrumb-->
        <form enctype="multipart/form-data" id="product" action="{{ route('seller.products.update', $data->id) }}"
            method="POST" class="row">
            @csrf
            @method('PUT')

            <div class="col-12 col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-4">
                            <h6 class="mb-3">Tên Sản Phẩm </h6>
                            <input type="text" name="namesanpham" value="{{ $data->name }}" class="form-control"
                                placeholder="nhận tên sản phẩm . . .">
                            <span class="text text-danger  error-namesanpham" id=""></span>
                        </div>
                        <div class="mb-4">
                            <h6 class="mb-3">Ảnh Sản Phẩm Chính </h6>
                            <div class="product-info">
                                <a href="{{ \Storage::url($data->image) }}" data-fancybox="sanpham"
                                    data-caption="{{ $data->name }}">
                                    <img src="{{ \Storage::url($data->image) }}" width="70" class="rounded-3"
                                        alt="">
                                </a>
                                </p>

                            </div>
                            <input id="" class="form-control w-50 " type="file" name="anhsanphamchinh">

                            <span class="text text-danger error-anhsanphamchinh" id=""></span>
                        </div>
                        <div class="mb-4">
                            <h6 class="mb-3">Mô tả ngắn : </h6>
                            <textarea class="form-control" name="motangan" id="content" cols="" rows=""
                                placeholder="nội dung. . .  ">{!! $data->short_description !!}</textarea>
                            <span class="text text-danger error-motangan" id=""></span>
                        </div>
                        <div class="mb-4">
                            <h6 class="mb-3">Nội Dung </h6>
                            <textarea class="form-control" name="noidung" id='content1' cols="2" rows="3"
                                placeholder="nội dung chính . . .  ">{!! $data->content !!}</textarea>
                            <span class="text text-danger error-noidung" id=""></span>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4 ">
                <div class="card">
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-12">
                                <label for="AddCategory" class="form-label">Danh mục </label>
                                <select class="form-select" name="danhmuc" id="cate"
                                    data-placeholder=" Vui lòng chọn danh mục">
                                    <option value=""> Vui lòng chọn danh mục </option>
                                    @foreach ($categories as $item)
                                        <option @selected($data->category_id == $item->id) value="{{ $item->id }}">
                                            {{ $item->name }}</option>
                                    @endforeach
                                </select>
                                <span class="text text-danger error-danhmuc" id=""></span>
                            </div>
                            <div class="col-12">
                                <label for="Collection" class="form-label">Mã Sản Phẩm </label>
                                <input type="text" name="masanpham" value="{{ $data->sku }}" class="form-control"
                                    id="Collection" placeholder="SKU_">
                                <span class="text text-danger error-masanpham" id=""></span>
                            </div>
                            <div class="col-12">
                                <div class="form-check form-switch form-check-success">
                                    <label class="form-check-label" for="flexSwitchCheckSuccess">Trạng thái hoạt
                                        động</label>
                                    <input class="form-check-input text-white" name="trangthai" type="checkbox"
                                        role="switch" id="flexSwitchCheckSuccess" @checked($data->status == 'active')>
                                </div>
                            </div>
                            <div class="col-12">
                                <label for="Tags" class="form-label">Giá Sản Phẩm </label>
                                <input type="text" name="giasanpham" value="{{ intval($data->price) }}"
                                    class="form-control" id="gia" placeholder="200.000">
                                <span class="text text-danger error-giasanpham" id=""></span>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between"> <span id="phantram"> </span> <span
                                    id="chietkhau">
                                </span> </div>

                        </div><!--end row-->
                    </div>
                </div>
                <div class="card">
                    <div class="card-body p-4">
                        <h5 class="mb-4">Bộ sưu tập </h5>
                        <input id="image-uploadify" name="gallery[]" class="form-control mb-3" type="file"
                            accept="image/*,.pdf" multiple>
                        <span class="text text-danger  error-gallery" id=""></span>
                        <div class="d-flex align-items-center gap-3">
                            <div class="product-box">
                                @foreach ($bosuutap as $item)
                                    <a href="{{ \Storage::url($item->image) }}" data-fancybox="gallery"
                                        data-caption="Bộ sưu tập ">
                                        <img src="{{ \Storage::url($item->image) }}" width="70" class="rounded-3"
                                            alt="">
                                    </a>
                                @endforeach
                            </div>
                        </div>

                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="">
                                <button type="submit" class="btn btn-success px-4 raised d-flex gap-2"><i
                                        class="material-icons-outlined">account_circle</i>Lưu sản phẩm </button>
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
                @foreach ($productVariants as $key => $item)
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between">
                                <h5 class="mb-0">Biến thể sản phẩm {{ $key + 1 }}</h5>

                            </div>
                            <div class="form-group row g-3">
                                @foreach ($item['bienthe'] as $val)
                                    <div class="col-md-6">
                                        <label for="input1" class="form-label">Giá Trị Biến Thể:
                                            {{ $val['nameAttribute'] }}</label>
                                        <input type="text" class="form-control"
                                            value="{{ $val['nameAttributeValue'] }}" disabled="">
                                        <input type="text" hidden value="{{ $item['id'] }}"
                                            name="variants[{{ $item['id'] }}][id]">

                                    </div>
                                @endforeach


                            </div>
                            <div class="form-group">
                                <label>Giá sản phẩm:</label>
                                <input type="text" name="variants[{{ $item['id'] }}][gia]"
                                    value="{{ intval($item['price']) }}" class="form-control"
                                    placeholder="Nhập giá biến thể">
                                <div class="error-variants-0-gia text-danger"></div>
                            </div>
                            <div class="form-group">
                                <label>Giảm giá:</label>
                                <input type="text" name="variants[{{ $item['id'] }}][giamgia]"
                                    value="{{ intval($item['price_sale']) }}" class="form-control"
                                    placeholder="Nhập giảm giá">
                                <div class="error-variants-0-giamgia text-danger"></div>
                            </div>
                            <div class="form-group">
                                <label>Mã sản phẩm:</label>
                                <input type="text" name="variants[{{ $item['id'] }}][sku]"
                                    value="{{ $item['sku'] }}" class="form-control" placeholder="SKU_">
                                <div class="error-variants-0-sku text-danger"></div>
                            </div>
                            <div class="form-group">
                                <label>Số lượng:</label>
                                <input type="text" name="variants[{{ $item['id'] }}][soluong]"
                                    value="{{ $item['stock_quantity'] }}"class="form-control">
                                <div class="error-variants-0-soluong text-danger"></div>
                            </div>
                            <div class="form-group">
                                <label>Ảnh sản phẩm:</label>
                                <div class="product-info">
                                    <a href="{{ \Storage::url($item['image']) }}" data-fancybox="sanpham"
                                        data-caption="{{ $data['name'] }}">
                                        <img src="{{ \Storage::url($item['image']) }}" width="70" class="rounded-3"
                                            alt="">
                                    </a>
                                    </p>

                                </div>
                                <input id="anhbienthe" class="form-control w-50" type="file"
                                    name="variants[{{ $item['id'] }}][anhbienthe]">
                                <div class="error-variants-0-anhbienthe text-danger"></div>
                            </div>
                            <div class="form-group">
                                <label>Ngày bắt đầu giảm giá:</label>
                                <input type="datetime-local" name="variants[{{ $item['id'] }}][ngaybd]"
                                    value="{{ $item['date_start'] }}" class="form-control">
                                <div class="error-variants-0-ngaybd text-danger"></div>
                            </div>
                            <div class="form-group">
                                <label>Ngày kết thúc giảm giá:</label>
                                <input type="datetime-local" name="variants[{{ $item['id'] }}][ngayketthuc]"
                                    value="{{ $item['date_end'] }}" class="form-control">
                                <div class="error-variants-0-ngayketthuc text-danger"></div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </form>

    </div>
@endsection
@section('css_new')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.5/dist/sweetalert2.min.css">
    <link href="https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3.5.1/dist/jquery.fancybox.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('theme/admin/assets/npm/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('theme/admin/assets/npm/select2-bootstrap-5/dist/select2-bootstrap-5-theme.min.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/admin/assets/plugins/notifications/css/lobibox.min.css') }}">
    <x-head.tinymce-config />
@endsection
@section('js_new')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.5/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3.5.1/dist/jquery.fancybox.min.js"></script>
    <script>
        let categories = @json($categories);
        let attributeValues = @json($attributeValues);
        let dulieu = {
            gia: parseInt("{{ $data->price }}"),
            idcategory: {{ $data->category_id }}
        };
        let routePost = "{{ route('seller.products.store') }}"
        let user_id = "{{ Auth::id() }}"
    </script>
    @if (session('success'))
        <script>
            Swal.fire({
                title: "Cập Nhật Thành Công !",
                text: "Dữ liệu đã được lưu ",
                icon: "success"
            });
        </script>
    @endif
    <script src="{{ asset('theme/admin/assets/npm/select2/dist/js/select2.min.js') }}"></script>
    <script src="{{ asset('theme/admin/assets/plugins/notifications/js/lobibox.min.js') }}"></script>
    <script src="{{ asset('theme/admin/assets/plugins/notifications/js/notifications.min.js') }}"></script>
    @vite('/resources/js/seller/product-edit.js')
@endsection
