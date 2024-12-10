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
                <div class="card">

                    <div class="card-body">


                        <div class="table-responsive">
                            <table id="rolesTable" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Mã Sản Phẩm </th>
                                        <th>Tên Sản Phẩm</th>
                                        <th>Thuộc Danh Mục</th>
                                        <th>Chết Khấu </th>
                                        <th>Ảnh Sản Phẩm </th>
                                        <th>Giá Sản Phẩm </th>
                                        <th>Trạng Thái </th>
                                        <th>Biến Thể </th>
                                        <th>Lượt Xem </th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $key =>  $item)
                                        <tr>
                                            <td>{{ $item->sku }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->category->name }}</td>
                                            <td>{{ $item->category->fee_percentage }}%</td>
                                            <td><img src="{{ Storage::url($item->image) }}" alt="{{ $item->name }}"
                                                    width="100"></td>
                                            <td>{{ $item->price }}</td>
                                            <td>
                                                @if ($item->is_verified == 0)
                                                    <span class="badge bg-primary">Chưa được phê duyệt </span>
                                                @else
                                                <span class="badge bg-success">Đã xác thực </span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="accordion accordion-flush" id="accordionFlushExample">
                                                    <div class="accordion-item">
                                                      <h2 class="accordion-header">
                                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne{{ $key }}"  aria-expanded="false" aria-controls="flush-collapseOne">
                                                          Xem Biến Thể
                                                        </button>
                                                      </h2>
                                                      <div id="flush-collapseOne{{ $key }}" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                                        <div class="accordion-body">dsfgdfgd</div>
                                                      </div>
                                                    </div>


                                                  </div>
                                            </td>
                                            <td>{{ $item->views }}</td>
                                            <td class="d-flex justify-content-around">
                                                <a href="http://" class="btn btn-grd-success"><i class="bi bi-pencil-square"></i></a>
                                                <form action="" method="post">
                                                    @csrf
                                                    @method("DELETE")
                                                     <button type="submit" class="btn btn-danger"> <i class="bi bi-trash"></i></button>
                                                </form>
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
@section('css_new')
    <link href="{{ asset('theme/admin/assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
@endsection
@section('js_new')
    <script src="{{ asset('theme/admin/assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('theme/admin/assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#rolesTable').DataTable({
                "aaSorting": [
                    [0, "asc"]
                ] // Sắp xếp theo cột đầu tiên
            });
        });
    </script>
@endsection
