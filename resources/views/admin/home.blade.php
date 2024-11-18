@extends('admin.layouts.master')

@section('content')
    <div class="main-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Dashboard</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">eCommerce</li>
                    </ol>
                </nav>
            </div>

            <div class="ms-auto">
                <div class="btn-group">
                    <button type="button" class="btn btn-primary">Settings</button>
                    <button type="button" class="btn btn-primary split-bg-primary dropdown-toggle dropdown-toggle-split"
                        data-bs-toggle="dropdown"> <span class="visually-hidden">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end"> <a class="dropdown-item"
                            href="javascript:;">Action</a>
                        <a class="dropdown-item" href="javascript:;">Another action</a>
                        <a class="dropdown-item" href="javascript:;">Something else here</a>
                        <div class="dropdown-divider"></div><a class="dropdown-item" href="javascript:;">Separated link</a>
                    </div>
                </div>
            </div>
        </div>
        <!--end breadcrumb-->


        <div class="row">

            {{-- Biểu đồ cột --}}

            <div class="col-12 col-lg-4 col-xxl-4 d-flex">
                <div class="card rounded-4 w-100">
                    <div class="card-body">
                        <h5 class="mb-3">Thống kê doanh thu Sản phẩm(2023-2024)</h5>
                        <canvas id="barChart" height="250"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-4 col-xxl-2 d-flex">
                <div class="card rounded-4 w-100">
                    <div class="card-body">
                        <div class="mb-3 d-flex align-items-center justify-content-between">
                            <div
                                class="wh-42 d-flex align-items-center justify-content-center rounded-circle bg-primary bg-opacity-10 text-primary">
                                <span class="material-icons-outlined fs-5">category</span>
                            </div>
                            <div>
                                <span class="text-success d-flex align-items-center">+24%<i
                                        class="material-icons-outlined">expand_less</i></span>
                            </div>
                        </div>
                        <div>
                            <h4 class="mb-0">{{ $categoryCount }}</h4>
                            <a href="{{ route('admin.category.index') }}"><i class="material-icons-outlined"></i>Danh
                                mục</a>
                            <div id="chart1"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4 col-xxl-2 d-flex">
                <div class="card rounded-4 w-100">
                    <div class="card-body">
                        <div class="mb-3 d-flex align-items-center justify-content-between">
                            <div
                                class="wh-42 d-flex align-items-center justify-content-center rounded-circle bg-success bg-opacity-10 text-success">
                                <span class="material-icons-outlined fs-5">store</span>
                            </div>
                            <div>
                                <span class="text-success d-flex align-items-center">+14%<i
                                        class="material-icons-outlined">expand_less</i></span>
                            </div>
                        </div>
                        <div>
                            <h4 class="mb-0">{{ $productsCount }}</h4>
                            <a href="{{ route('admin.category.index') }}"><i class="material-icons-outlined"></i>Sản
                                phẩm</a>
                            <div id="chart2"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6 col-xxl-2 d-flex">
                <div class="card rounded-4 w-100">
                    <div class="card-body">
                        <div class="mb-3 d-flex align-items-center justify-content-between">
                            <div
                                class="wh-42 d-flex align-items-center justify-content-center rounded-circle bg-info bg-opacity-10 text-info">
                                <span class="material-icons-outlined fs-5">shopping_cart</span>
                            </div>
                            <div>
                                <span class="text-danger d-flex align-items-center">-35%<i
                                        class="material-icons-outlined">expand_less</i></span>
                            </div>
                        </div>
                        <div>
                            <h4 class="mb-0">{{ $orderCount }}</h4>
                            <p class="mb-3">Đơn hàng</p>
                            <div id="chart3"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6 col-xxl-2 d-flex">
                <div class="card rounded-4 w-100">
                    <div class="card-body">
                        <div class="mb-3 d-flex align-items-center justify-content-between">
                            <div
                                class="wh-42 d-flex align-items-center justify-content-center rounded-circle bg-warning bg-opacity-10 text-warning">
                                <span class="material-icons-outlined fs-5">account_circle</span>

                            </div>
                            <div>
                                <span class="text-success d-flex align-items-center">+18%<i
                                        class="material-icons-outlined">expand_less</i></span>
                            </div>
                        </div>
                        <div>
                            <h4 class="mb-0">{{ $userCount }}</h4>
                            <p class="mb-3">Tài Khoản</p>
                            <div id="chart4"></div>
                        </div>
                    </div>
                </div>
            </div>

        </div><!--end row-->


        <div class="row">
            <div class="col-12 col-md-6 col-lg-4 col-xl-3 mb-3"> <!-- Điều chỉnh độ rộng cột -->
                <div class="card w-100 rounded-4">
                    <div class="card-body">
                        <h5 class="mb-3">Thống kê trạng thái thanh toán</h5>
                        <canvas id="paymentStatusChart" height="150"></canvas>
                        <div class="mt-3">
                            <ul>
                                @foreach ($paymentStatusCounts as $statusCount)
                                    <li><strong>{{ $statusCount->name }}:</strong> {{ $statusCount->count }} lần</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-12 col-xl-8">
                <div class="card w-100 rounded-4">
                    <div class="card-body">
                        <h4 class="card-title">Biểu đồ thống kê đơn hàng theo tháng</h4>
                        <canvas id="orderChart"></canvas>
                    </div>
                </div>
            </div>
        </div><!--end row-->
    </div>
@endsection
