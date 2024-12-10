@extends('admin.layouts.master')

@section('content')
    <div class="main-content">
        @include('admin.components.breadcrumb', [
            'name' => 'Phê duyệt sản phẩm',
            'link' => 'admin.phe-duyet.index',
            'detail' => 'Admin',
        ])

        <div class="row">
            <div class="col-12">
                <div class="card mt-4">
                    <div class="card-body">
                        <div class="product-table">
                            <div class="table-responsive white-space-nowrap">
                                <table class="table align-middle" id="bang">
                                    <thead class="table-light mt-3">
                                        <tr>
                                            <th>
                                                Mã Sản Phẩm
                                            </th>
                                            <th>Sản Phẩm </th>
                                            <th>Giá </th>
                                            <th>Ngày đăng </th>
                                            <th>Trạng thái  </th>
                                            <th>Hành động </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($products as $item)
                                            @php
                                                $price = $item->variants()->pluck('price'); // Lấy tất cả giá trị 'price' từ các variants

                                                $minPrice =
                                                $price->min() <= $item->price ? $price->min() : $item->price; // Giá nhỏ nhất
                                                $maxPrice = $price->max() >=  $item->price ? $price->max() : $item->price   ; // Giá lớn nhất

                                                // dd($minPrice, $maxPrice);

                                            @endphp

                                            <tr>
                                                <td>
                                                    {{ $item->sku }}
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center gap-3">
                                                        <div class="product-box">
                                                            <img src="{{ \Storage::url($item->image) }}"
                                                                width="70" class="rounded-3" alt="">
                                                        </div>
                                                        <div class="product-info">
                                                            <a href="javascript:;" class="product-title">
                                                                {{ $item->name }}
                                                            </a>
                                                            <p class="mb-0 product-category">Danh mục :
                                                                {{ $item->category->name }}</p>
                                                            <p class="mb-0 product-category">Người Bán :
                                                                {{ $item->seller->store_name }}</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    {{ number_format($minPrice, 0, ',', '.') . ' VNĐ' }} -
                                                    {{ number_format($maxPrice, 0, ',', '.') . ' VNĐ' }}
                                                </td>
                                                <td>
                                                    {{ $item->created_at->locale('vi')->format('h:i A - d , \T\h\á\n\g m') }}

                                                </td>
                                                <td class="pro-{{ $item->id }}">
                                                @if ($item -> is_verified == 0 )
                                                <span class="badge bg-primary  ">Chờ xét duyệt </span >

                                                @elseif ($item -> is_verified == 1)
                                                <span class="badge bg-success  ">Đã phê duyệt </span >

                                                @else
                                                <span class="badge bg-danger  ">Đã từ chối  </span >
                                                @endif


                                                </td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button
                                                            class="btn btn-sm btn-filter dropdown-toggle dropdown-toggle-nocaret"
                                                            type="button" data-bs-toggle="dropdown">
                                                            <i class="bi bi-three-dots"></i>
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            @if ($item -> is_verified == 0      )
                                                            <li><a class="dropdown-item duyet" data-id="{{ $item->id }}" href="#">Duyệt</a></li>
                                                            <li><a class="dropdown-item tuchoi"  data-id="{{ $item->id }}" href="#">Từ Chối </a></li>
                                                            @endif

                                                            <li><a class="dropdown-item" href="{{ route('admin.phe-duyet.show' , $item->id ) }}">Xem Chi Tiêt</a>
                                                            </li>
                                                        </ul>
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
    <!-- Modal -->
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

    <link href="{{ asset('theme/admin/assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.5/dist/sweetalert2.min.css">
@endsection
@section('js_new')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.5/dist/sweetalert2.all.min.js"></script>
    <script src="{{ asset('theme/admin/assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('theme/admin/assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#bang').DataTable({
                // display everything

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

@vite('resources/js/admin/product.js')
@endsection
