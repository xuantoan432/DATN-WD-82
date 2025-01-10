@extends('seller.layouts.master')
@section('content')
    <div class="main-content">
        @include('seller.components.breadcrumb', [
            'name' => 'Danh Sách Sản Phẩm',
            'link' => 'seller.products.index',
            'detail' => 'Sản Phẩm',
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
                                            <th>Lượt xem</th>
                                            <th>Đã bán</th>
                                            <th>Trạng thái</th>
                                            <th>Hành động </th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($products as $item)
                                            @php
                                                $price = $item->variants()->pluck('price');

                                                $minPrice =
                                                    $price->min() <= $item->price ? $price->min() : $item->price;
                                                $maxPrice =
                                                    $price->max() >= $item->price ? $price->max() : $item->price;
                                            @endphp

                                            <tr>
                                                <td>
                                                    {{ $item->sku }}
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center gap-3">
                                                        <div class="product-box">
                                                            <img src="{{ \Storage::url($item->image) }}" width="70"
                                                                class="rounded-3" alt="">
                                                        </div>
                                                        <div class="product-info">
                                                            <a href="javascript:;" class="product-title">
                                                                {{ $item->name }}
                                                            </a>
                                                            <p class="mb-0 product-category">Danh mục :
                                                                {{ $item->category->name }}</p>
                                                            <p class="mb-0 product-category">Số lượng :
                                                                {{ $item->category->name }}</p>
                                                            <p class="mb-0 product-category">Chiết Khấu :
                                                                {{ $item->category->fee_percentage }}%</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    {{ number_format($minPrice, 0, ',', '.') . ' VNĐ' }} -
                                                    {{ number_format($maxPrice, 0, ',', '.') . ' VNĐ' }}
                                                </td>
                                                <td>
                                                    {{ $item->formatted_views }}

                                                </td>
                                                <td>
                                                    0 sản phẩm
                                                </td>
                                                <td>
                                                    @if ($item->status == 'inactive')
                                                        <span class="badge bg-danger  ">ngừng hoạt động</span>
                                                    @elseif ($item->status == 'active')
                                                        <span class="badge bg-success  ">hoạt động</span>
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

                                                            <li><a class="dropdown-item"
                                                                    href="{{ route('seller.products.show', $item->id) }}">Chi
                                                                    tiết </a> </li>
                                                            <li><a class="dropdown-item"
                                                                    href="{{ route('seller.products.edit', $item->id) }}">Chỉnh
                                                                    sửa </a> </li>
                                                            <li>
                                                                <p class="dropdown-item xoa" data-id="{{ $item->id }}">
                                                                    Xoá</p>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>
                                                <td></td>
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
    <link rel="stylesheet" href="{{ asset('theme/admin/assets/plugins/notifications/css/lobibox.min.css') }}">
    <link href="{{ asset('theme/admin/assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.5/dist/sweetalert2.min.css">
@endsection
@section('js_new')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.5/dist/sweetalert2.all.min.js"></script>
    <script src="{{ asset('theme/admin/assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('theme/admin/assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
    <script>
        var table = null ;
      $(document).ready(function() {
         table =   $('#bang').DataTable({
                searching: true,
                lengthChange: false,
                language: {
                    info: " Từ _START_ đến _END_ trong  _TOTAL_ mục",
                    search: "Tìm Kiếm : ",
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
    <script src="{{ asset('theme/admin/assets/plugins/notifications/js/lobibox.min.js') }}"></script>
    <script src="{{ asset('theme/admin/assets/plugins/notifications/js/notifications.min.js') }}"></script>
    @vite('/resources/js/seller/app.js')
@endsection
