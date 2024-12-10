@extends('admin.layouts.master')

@section('content')
    <div class="main-content">
        @include('admin.components.breadcrumb', [
            'name' => 'Phê duyệt sản phẩm',
            'link' => 'admin.phe-duyet.index',
            'detail' => 'Admin',
        ])
        <div class="row">
            <div class="col-12 col-xl-6">
                <div class="card">
                    <div class="card-body p-4">
                        <h5 class="mb-4 d-flex justify-content-between">Thông tin chi tiết  <span id="html">
                            @if ($product->is_verified <= 0 )
                            <button   class="btn btn-grd-danger tuchoi" id="" data-id="{{ $product->id }}" ><i class="bi bi-exclamation-circle"></i></button>
                            <button  class="btn btn-success"  id="duyet" data-id="{{ $product->id }}" ><i class="bi bi-check2-all"></i></button>
                            @else
                                 @if ($product -> is_verified == 1)
                                    <span class="badge bg-success  ">Đã phê duyệt </span >
                                @else
                                <span class="badge bg-danger  ">Đã từ chối  </span >
                                @endif
                            @endif
                        </span>
                        </h5>
                        <div class="d-flex align-items-center gap-3">
                            <div class="product-info">
                                <p class="mb-0 product-category">Tên sản phẩm :
                                    {{ $product->name }}
                                </p>
                                <p class="mb-0 product-category">Danh mục :
                                    {{ $product->category->name }}
                                </p>
                                <p class="mb-0 product-category">Giá gốc :
                                    {{ number_format($product->price, 0, ',', '.') . ' VNĐ' }}

                                </p>
                                <p class="mb-0 product-category">Chiết khấu :
                                    {{ $product->category->fee_percentage }} %
                                </p>
                                <p class="mb-0 product-category">Người Bán :
                                    {{ $product->seller->store_name }}
                                </p>
                                <p class="mb-0 product-category">Ngày đăng :
                                    {{ $product->created_at->locale('vi')->format('h:i A - d , \T\h\á\n\g m') }}
                                </p>

                            </div>
                            <div class="product-info">
                                <p class="mb-2 product-category">Ảnh sản phẩm : <br>
                                    <a href="{{ \Storage::url($product->image) }}" data-fancybox="sanpham"
                                        data-caption="{{ $product->name }}">
                                        <img src="{{ \Storage::url($product->image) }}" width="70" class="rounded-3"
                                            alt="">
                                    </a>

                                </p>

                            </div>
                        </div>

                    </div>
                </div>
                <div class="card">
                    <div class="card-body p-4">
                        <h5 class="mb-4">Bộ sưu tập </h5>
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
            </div>
            <div class="col-12 col-xl-6">
                <div class="card">
                    <div class="card-body p-4">
                        <h5 class="mb-4">Các biến thể </h5>
                        <div class="product-table">
                            <div class="table-responsive white-space-nowrap">
                                <table class="table align-middle" id="bang">
                                    <thead class="table-light mt-3">
                                        <tr>
                                            <th>
                                                Mã Sản Phẩm
                                            </th>
                                            <th>Sản phẩm </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($bienthe as $key => $item)
                                            <tr>
                                                <td> {{ $item['sku'] }}</td>
                                                <td>
                                                    <div class="d-flex align-items-center gap-3">
                                                        <div class="product-box">
                                                            <a href="{{ \Storage::url($item['image']) }}" data-fancybox="sanpham"
                                                                data-caption="{{ $product->name . $key+1  }}">
                                                                <img src="{{ \Storage::url($item['image']) }}" width="70" class="rounded-3"
                                                                    alt="">
                                                            </a>

                                                        </div>
                                                        <div class="product-info">
                                                            @foreach ($item['bienthe'] as $i)
                                                                <p class="mb-0 product-category">
                                                                    {{ $i }}</p>
                                                            @endforeach
                                                            <p class="mb-0 product-category">
                                                                Số lượng : {{ $item['stock_quantity'] }}</p>
                                                            <p class="mb-0 product-category">
                                                                Giá :
                                                                {{ number_format($item['price'], 0, ',', '.') . ' đ' }}</p>
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
    </div>
    <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
        <form class="modal-dialog modal-dialog-centered" enctype="multipart/form-data" id="product">
            @csrf
          <div class="modal-content">
            <div class="modal-header border-bottom-0 py-2 bg-grd-danger">
              <h5 class="modal-title" id="myModalLabel">Nhập lý do từ chối</h5>
              <input type="hidden" name="id" id="pro-id">
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

              <textarea type="text" id="inputField"  name="nd" class="form-control" placeholder="Nhập lý do ..." rows="3"> </textarea>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="closeModal">Đóng</button>
              <button type="submit" class="btn btn-primary" id="confirmBtn">Từ Chối</button>
            </div>
          </div>
        </form>
      </div>
@endsection
@section('css_new')
    <!-- Fancybox CSS -->
    <link href="https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3.5.1/dist/jquery.fancybox.min.css" rel="stylesheet">

    <link href="{{ asset('theme/admin/assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.5/dist/sweetalert2.min.css">
@endsection
@section('js_new')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.5/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3.5.1/dist/jquery.fancybox.min.js"></script>
    <script src="{{ asset('theme/admin/assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('theme/admin/assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#bang').DataTable({
                pageLength: 2,
                // display everything
                "aaSorting": [
                    [0, "desc"]
                ],
                searching: false,
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
        const appUrl = @json(config('app.url'));
    </script>
    @vite('resources/js/admin/product1.js')
@endsection
