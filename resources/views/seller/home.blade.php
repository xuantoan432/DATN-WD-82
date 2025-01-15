@extends('seller.layouts.master')
@section('content')
    <div class="main-content">

        <!--breadcrumb-->
        @include('seller.components.breadcrumb', [
            'name' => 'Dashboard',
            'link' => 'seller.index',
            'detail' => '',
        ])
        <!--end breadcrumb-->

        <!--thông kê doanh thu-->
        <div class="row">
            <div class="col-12 col-lg-4 col-xxl-5 d-flex">
                <div class="card rounded-4 w-100">
                    <div class="card-body">
                        <div class="">
                            <div class="d-flex align-items-center gap-2 mb-2">
                                <h5 class="mb-0">{{Auth::user()->seller->store_name }}</h5>
                            </div>
                            <p class="mb-4">xin chào bạn , đến với trang quản trị </p>
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="">
                                    <p class="">Tổng tài khoản : </p>
                                    <h4 class="mb-0 text-indigo " id="taikhoan">0 VNĐ</h4>
                                </div>
                                <img src="{{asset('theme/admin/assets/images/apps/gift-box-3.png')}}" width="100"
                                     alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4 col-xxl-3 d-flex">
                <div class="card rounded-4 w-100">
                    <div class="card-body">
                        <div class="mb-3 d-flex align-items-center justify-content-between">
                            <div
                                class="wh-42 d-flex align-items-center justify-content-center rounded-circle bg-primary bg-opacity-10 text-primary">
                                <span class="material-icons-outlined fs-5">shopping_cart</span>
                            </div>
                            <div id="phamtramdon">

                            </div>
                        </div>
                        <div>
                            <h4 class="mb-0" id="tongdon">0 đơn</h4>
                            <p class="mb-3">Tổng số đơn hàng trong ngày : </p>
                            <div id="chart1"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4 col-xxl-4 d-flex">
                <div class="card rounded-4 w-100">
                    <div class="card-body">
                        <div class="mb-3 d-flex align-items-center justify-content-between">
                            <div
                                class="wh-42 d-flex align-items-center justify-content-center rounded-circle bg-success bg-opacity-10 text-success">
                                <span class="material-icons-outlined fs-5">attach_money</span>
                            </div>
                            <div id="phantramdoanhthu">

                            </div>
                        </div>
                        <div>
                            <h4 class="mb-0" id="doanhthu">0 VNĐ</h4>
                            <p class="mb-3">Tổng doanh thu trong ngày : </p>
                            <div id="chart2"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end row-->

        {{-- sản phẩm --}}
        <div class="row">
            <div class="col-12 col-xl-4">
                <div class="card w-100 rounded-4">
                    <div class="card-body">
                        <div class="d-flex flex-column gap-3">
                            <div class="d-flex align-items-start justify-content-between">
                                <div class="">
                                    <h5 class="mb-0">Sản Phẩm </h5>
                                </div>

                            </div>
                            <div class="position-relative">
                                <div class="piechart-legend">
                                    <h2 class="mb-1" id="sanpham">0</h2>
                                    <h6 class="mb-0">Tổng sản phẩm</h6>
                                </div>
                                <div id="chart6"></div>
                            </div>
                            <div class="d-flex flex-column gap-3 categoryproducts">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{--doanh thu theo quy năm tháng --}}
            <div class="col-12 col-xl-8">
                <div class="card w-100 rounded-4">
                    <div class="card-body">
                        <div class="d-flex align-items-start justify-content-between mb-3">
                            <div class="">
                                <h5 class="mb-0">Thông Kê</h5>
                            </div>
                            <div class="dropdown">
                                <a href="javascript:;" class="dropdown-toggle-nocaret options dropdown-toggle"
                                   data-bs-toggle="dropdown">
                                    <span class="material-icons-outlined fs-5">more_vert</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" id="data-ngay" href="javascript:;">Theo Ngày </a></li>
                                    <li><a class="dropdown-item" id="data-tuan" href="javascript:;">Theo Tuần </a></li>
                                    <li><a class="dropdown-item" id="data-thang" href="javascript:;">Theo Tháng </a>
                                    </li>
                                    <li><a class="dropdown-item" id="data-nam" href="javascript:;">Theo Năm</a></li>
                                </ul>
                            </div>
                        </div>
                        <div id="chart5"></div>

                    </div>
                </div>
            </div>
        </div>
        <!--end row-->

        {{--top sản phẩm --}}
        <div class="row">


            <div class="col-12  d-flex">
                <div class="card w-100 rounded-4">
                    <div class="card-body">
                        <div class="d-flex align-items-start justify-content-between mb-3">
                            <div class="">
                                <h5 class="mb-0">Đơn hàng gần đây </h5>
                            </div>

                        </div>
                        <div class="table-responsive">
                            <table class="table align-middle mb-0 table-striped" id="bang">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Thời Gian</th>
                                    <th>Mã Đơn Hàng</th>
                                    <th>Sản Phẩm</th>

                                    <th>Trạng Thái</th>
                                    <th> Tổng Tiền</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($odder as $val  )
                                    <tr>
                                        <td>{{$val->id }}</td>
                                        <td>
                                            <div class="">
                                                {{ $val->created_at->locale('vi')->format('h:i A - d , \T\h\á\n\g m') }}
                                            </div>
                                        </td>
                                        <td>
                                            <span class="mb-0">{{$val -> order -> order_code}}</span>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center gap-3">
                                                <div class="product-box">
                                                    <img src="{{ \Storage::url($val->image) }}"
                                                         width="70" class="rounded-3" alt="">
                                                </div>
                                                <div class="product-info">
                                                    <a href="javascript:;" class="product-title">
                                                        {{ $val->name }}
                                                    </a>
                                                    <p class="mb-0 product-category">Biến thể :
                                                        {{ $val->variant_name }}</p>
                                                    <p class="mb-0 product-category">Số Lượng  :
                                                        {{ $val->quantity }}</p>
                                                </div>
                                            </div>
                                        </td>

                                        <td>
                                            @php
                                                $badgeClass = '';
                                                $statusText = '';
                                                switch ($val->status) {
                                                    case 'Pending':
                                                        $badgeClass = 'bg-warning';
                                                        $statusText = 'Đang chờ xử lý';
                                                        break;

                                                    case 'Processing':
                                                        $badgeClass = 'bg-info';
                                                        $statusText = 'Đang xử lý';
                                                        break;
                                                    case 'Shipping':
                                                        $badgeClass = 'bg-info';
                                                        $statusText = 'Đang giao';
                                                        break;
                                                    case 'Completed':
                                                        $badgeClass = 'bg-success';
                                                        $statusText = 'Hoàn thành';
                                                        break;

                                                    case 'Cancelled':
                                                        $badgeClass = 'bg-danger';
                                                        $statusText = 'Đã hủy';
                                                        break;

                                                    default:
                                                        $badgeClass = 'bg-secondary';
                                                        $statusText = 'Không xác định';
                                                        break;
                                                }
                                            @endphp
                                            <span class="badge {{ $badgeClass }}">{{ $statusText }}</span>
                                        </td>
                                        <td>
                                            <span class="mb-0">{{ number_format($val->price, 0, ',', '.') . ' VNĐ' }}</span>
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--end row-->
        {{--danh sách odder --}}


    </div>
@endsection

@section('css_new')
    <link href="{{ asset('theme/admin/assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
@endsection
@section('js_new')
    <script src="{{asset('theme/admin/assets/plugins/apexchart/apexcharts.min.js')}}"></script>
    <script src="{{asset('theme/admin/assets/plugins/peity/jquery.peity.min.js')}}"></script>
    <script src="{{ asset('theme/admin/assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('theme/admin/assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
    <script>
        let data = @json($data);
        // console.log(data);
        var table = null ;
        $(document).ready(function() {
            table =   $('#bang').DataTable({
                "aaSorting": [
                    [0, "desc"]
                ] ,
                searching: true,
                lengthChange: false,
                language: {
                    info: " Từ _START_ đến _END_ trong  _TOTAL_ mục",
                    search: "Tìm Kiếm : ",
                    infoEmpty: "Không có dữ liệu để hiển thị",

                    pageLength: 7,
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
        $(".data-attributes span").peity("donut")
    </script>
    @vite('resources/js/seller/dashboard.js')

@endsection
