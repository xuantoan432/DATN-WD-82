@extends('seller.layouts.master')

@section('content')
    <div class="main-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Seller</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item active" aria-current="page">Danh sách đánh giá</li>
                    </ol>
                </nav>
            </div>

        </div>
        <!--end breadcrumb-->
        <div class="row">
            <div class="col-12">
                <div class="card mt-4">
                    <div class="card-body">
                        <div class="product-table">
                            <div class="table-responsive white-space-nowrap">
                                <table class="table align-middle" id="bang">
                                    <thead class="table-light mt-3">
                                    <tr>
                                        <th>Sản Phẩm </th>
                                        <th>Người dùng</th>
                                        <th style="width: 130px">Sao </th>
                                        <th style="width: 170px">Bình luận</th>
                                        <th>Image</th>
                                        <th>Hành động </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($reviews as $review)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center gap-3">
                                                    <div class="product-box">
                                                        <img src="{{ \Storage::url($review->product->image) }}"
                                                             width="70" class="rounded-3" alt="">
                                                    </div>
                                                    <div class="product-info">
                                                        <a href="javascript:;" class="product-title">
                                                            {{ $review->product->name }}
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                {{ $review->user->name }}
                                            </td>
                                            <td class="text-center">
                                                @for($i = 1; $i <= 5; $i++)
                                                    @if($i <= $review->star)
                                                        <i class="material-icons-outlined text-warning">star</i>
                                                    @else
                                                        <i class="material-icons-outlined ">star</i>
                                                    @endif
                                                @endfor
                                            </td>
                                            <td>
                                               {{ $review->content }}
                                            </td>
                                            <td>
                                                <img src="{{ \Storage::url($review->image) }}" alt="">

                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('seller.reviews.edit', $review) }}"
                                                   class="btn">
                                                    <span class="material-icons-outlined">visibility</span>
                                                </a>
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

@endsection
@section('css_new')
    <link href="{{asset('theme/admin/assets/plugins/datatable/css/dataTables.bootstrap5.min.css')}}" rel="stylesheet"/>
@endsection
@section('js_new')

    <script src="{{asset('theme/admin/assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('theme/admin/assets/plugins/datatable/js/dataTables.bootstrap5.min.js')}}"></script>
    <script>
        $(document).ready(function() {
            $('#bang').DataTable({
                // display everything
                order: false,
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
    </script>
@endsection
