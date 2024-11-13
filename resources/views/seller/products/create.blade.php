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
        <form enctype="multipart/form-data" id="product"  class="row">
            <div class="col-12 col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-4">
                            <h6 class="mb-3">Tên Sản Phẩm </h6>
                            <input type="text" name="namesanpham" class="form-control" placeholder="nhận tên sản phẩm . . .">
                            <span class="text text-danger  error-namesanpham" id=""></span>
                        </div>
                        <div class="mb-4">
                            <h6 class="mb-3">Ảnh Sản Phẩm Chính </h6>
                            <input id="" class="form-control" type="file" name="anhsanphamchinh">
                            <span class="text text-danger error-anhsanphamchinh" id=""></span>
                        </div>
                        <div class="mb-4">
                            <h6 class="mb-3">Mô tả ngắn : </h6>
                            <textarea class="form-control" name="motangan" id="content" cols="" rows="" placeholder="nội dung. . .  "></textarea>
                            <span class="text text-danger error-motangan" id=""></span>
                        </div>
                        <div class="mb-4">
                            <h6 class="mb-3">Nội Dung </h6>
                            <textarea class="form-control" name="noidung" id='content1' cols="2" rows="3"
                                placeholder="nội dung chính . . .  "></textarea>
                                <span class="text text-danger error-noidung" id=""></span>
                        </div>
                        <div class="mb-4">
                            <h6 class="mb-3">Bộ sưu tập </h6>
                            <input id="image-uploadify" name="gallery[]" class="form-control" type="file" accept="image/*,.pdf"  multiple>
                            <span class="text text-danger error-gallery" id=""></span>
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
                                        <option value="{{ $item->id }}"> {{ $item->name }}</option>
                                    @endforeach
                                </select>
                                <span class="text text-danger error-danhmuc" id=""></span>
                            </div>
                            <div class="col-12">
                                <label for="Collection" class="form-label">Mã Sản Phẩm </label>
                                <input type="text" name="masanpham" class="form-control" id="Collection"
                                    placeholder="SKU_">
                                    <span class="text text-danger error-masanpham" id=""></span>
                            </div>
                            <div class="col-12">
                                <label for="Tags" class="form-label">Giá Sản Phẩm </label>
                                <input type="text" name="giasanpham" class="form-control" id="gia"
                                    placeholder="200.000">
                                <span class="text text-danger error-giasanpham" id=""></span>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between"> <span id="phantram">  </span> <span
                                    id="chietkhau">
                                </span> </div>

                        </div><!--end row-->
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <h5 class="mb-3">Biến Thể Sản Phẩm </h5>
                        <div class="row g-3">
                            <div class="col-12">
                                <select class="form-select" id="bien-the" name="bienthe[]" data-placeholder="Chọn dữ liệu cho biến thể"
                                    multiple>
                                    @foreach ($bienthe as $item)
                                        <option value="{{ $item->id }}"> {{ $item->name }}</option>
                                    @endforeach
                                </select>
                                <span class="text text-danger error-valuebute" id=""></span>
                            </div>
                            <div class="col-12">
                                <div class="d-grid">
                                    <button type="button" id="add-item-btn" class="btn btn-primary">Thêm biến thể </button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="">
                                <button type="submit"  class="btn btn-success px-4 raised d-flex gap-2"><i
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
        </form>

    </div>
    <div class="modal fade" id="FormModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-bottom-0 py-2 bg-grd-info">
                    <h5 class="modal-title">Chọn giá trị cho biến thể </h5>
                    <a href="#" class="primaery-menu-close" data-bs-dismiss="modal">
                        <i class="material-icons-outlined">close</i>
                    </a>
                </div>
                <div class="modal-body">
                    <div class="form-body" id="vaule-bienthe">

                    </div>
                    <div class="col-md-12">
                        <div class="d-md-flex d-grid align-items-center gap-3">
                            <button type="button" class="btn btn-grd-danger px-4" id="them-bien-the">Thêm Biến thể
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('css_new')
    <link rel="stylesheet" href="{{ asset('theme/admin/assets/npm/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('theme/admin/assets/npm/select2-bootstrap-5/dist/select2-bootstrap-5-theme.min.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/admin/assets/plugins/notifications/css/lobibox.min.css') }}">
    {{-- <link href="{{ asset('theme/admin/assets/plugins/Drag-And-Drop/dist/imageuploadify.min.css') }}" rel="stylesheet"> --}}
    {{-- <link href="https://cdn.jsdelivr.net/npm/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet"> --}}

@endsection
@section('js_new')
    <script src="https://cdn.ckeditor.com/4.22.1/full/ckeditor.js"></script>
    {{-- <script src="{{ asset('theme/admin/assets/plugins/Drag-And-Drop/dist/imageuploadify.min.js') }}"></script> --}}
    <script>
        CKEDITOR.replace('content', {
            height: 100
        });
        CKEDITOR.replace('content1');
        let categories = @json($categories);
        let attributeValues = @json($attributeValues);
        let routePost = "{{ route('seller.products.store') }}"
        console.log(routePost);
        let user_id = "{{ Auth::id() }}"
    </script>
    <script src="{{ asset('theme/admin/assets/npm/select2/dist/js/select2.min.js') }}"></script>
    <script src="{{ asset('theme/admin/assets/plugins/notifications/js/lobibox.min.js') }}"></script>
    <script src="{{ asset('theme/admin/assets/plugins/notifications/js/notifications.min.js') }}"></script>
    @vite('/resources/js/seller/product.js')
@endsection
