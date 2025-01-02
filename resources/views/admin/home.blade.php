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

        <form method="GET" action="{{ route('admin.index') }}" style="display: flex; align-items: center; gap: 10px;">
            <label for="year" style="font-size: 16px; color: #ffffff;">Chọn năm:</label>
            <select 
                name="year" 
                id="year" 
                onchange="this.form.submit()" 
                style="width: 100px; padding: 5px; font-size: 16px; border-radius: 8px; border: 1px solid #4a4a4a; background-color: #1e1e2d; color: #fff; appearance: none; background-image: url('data:image/svg+xml,%3Csvg xmlns=%27http://www.w3.org/2000/svg%27 viewBox=%270 0 4 5%27%3E%3Cpath fill=%27%23fff%27 d=%27M2 0L0 2h4z%27/%3E%3C/svg%3E'); background-repeat: no-repeat; background-position: right 10px center; background-size: 12px; transition: all 0.3s ease;">
                @for ($i = 2022; $i <= now()->year; $i++)
                    <option value="{{ $i }}" {{ $i == $year ? 'selected' : '' }}>{{ $i }}</option>
                @endfor
            </select>
        </form>

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

@section('js_new')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    {{-- <pre>
{{ var_dump($labels) }}
{{ var_dump($data) }}
</pre> --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Lấy dữ liệu từ controller truyền vào view
            var months = @json(session('monthlyRevenue')->pluck('month')); // Lấy tháng
            var revenues = @json(session('monthlyRevenue')->pluck('total_revenue')); // Lấy tổng doanh thu

            // Chuyển đổi tháng thành tên tháng (ví dụ: "Tháng 1", "Tháng 2", ...)
            var labels = months.map(function(month) {
                return 'T' + month;
            });

            // Khởi tạo biểu đồ
            var ctx = document.getElementById('barChart').getContext('2d');
            var barChart = new Chart(ctx, {
                type: 'bar', // Biểu đồ cột
                data: {
                    labels: labels, // Nhãn là các tháng
                    datasets: [{
                        label: 'Doanh thu (VND)', // Tiêu đề của biểu đồ
                        data: revenues, // Dữ liệu doanh thu
                        backgroundColor: '#3498db', // Màu nền của các cột
                        borderColor: '#2980b9', // Màu viền của cột
                        borderWidth: 1 // Độ dày viền cột
                    }]
                },
                options: {
                    responsive: true, // Đảm bảo biểu đồ sẽ co giãn theo kích thước màn hình
                    scales: {
                        y: {
                            beginAtZero: true, // Đảm bảo trục Y bắt đầu từ 0
                            ticks: {
                                callback: function(value) {
                                    return value.toLocaleString(); // Định dạng số cho trục Y
                                }
                            }
                        }
                    }
                }
            });
        });


        document.addEventListener('DOMContentLoaded', function() {
            var ctx = document.getElementById('paymentStatusChart').getContext('2d');
            var paymentStatusChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: @json($labels), // Truyền mảng $labels từ PHP sang JS
                    datasets: [{
                        data: @json($data), // Truyền mảng $data từ PHP sang JS
                        backgroundColor: ['#FF5733', '#FFBD33', '#75FF33', '#33FFBD',
                            '#3375FF'
                        ], // Màu sắc từng phần
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top'
                        }
                    }
                }
            });
        });

        document.addEventListener("DOMContentLoaded", function() {
            // Lấy dữ liệu từ controller
            const monthlyOrderData = @json($monthlyOrderCount); // Truyền dữ liệu từ controller vào JavaScript

            // Xử lý dữ liệu cho biểu đồ
            const labels = monthlyOrderData.map(order => 'Tháng' + String(order.month).padStart(2, '0'));
            const totalOrders = monthlyOrderData.map(order => order.total_orders);

            // Vẽ biểu đồ đường
            const ctx = document.getElementById('orderChart').getContext('2d');
            const chart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Số lượng đơn hàng',
                        data: totalOrders,
                        borderColor: 'rgb(75, 192, 192)',
                        fill: false
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        x: {
                            title: {
                                display: true,
                                text: 'Tháng/Năm'
                            }
                        },
                        y: {
                            title: {
                                display: true,
                                text: 'Số lượng đơn hàng'
                            },
                            beginAtZero: true
                        }
                    }
                }
            });
        });

        document.addEventListener("DOMContentLoaded", function() {
            const yearSelect = document.getElementById("yearSelect");

            yearSelect.addEventListener("change", function() {
                const selectedYear = this.value;

                // Gửi yêu cầu AJAX đến server
                fetch(`/admin/statistics?year=${selectedYear}`)
                    .then(response => response.json())
                    .then(data => {
                        // Cập nhật biểu đồ doanh thu
                        updateBarChart(data.monthlyRevenue);

                        // Cập nhật biểu đồ trạng thái thanh toán
                        updatePaymentStatusChart(data.paymentStatusCounts);

                        // Cập nhật biểu đồ đơn hàng
                        updateLineChart(data.monthlyOrderCount);
                    })
                    .catch(error => console.error("Error fetching data:", error));
            });
        });

        // Hàm cập nhật biểu đồ cột (doanh thu)
        function updateBarChart(revenueData) {
            const labels = revenueData.map(item => `Tháng ${item.month}`);
            const data = revenueData.map(item => item.total_revenue);

            barChart.data.labels = labels;
            barChart.data.datasets[0].data = data;
            barChart.update();
        }

        // Hàm cập nhật biểu đồ tròn (trạng thái thanh toán)
        function updatePaymentStatusChart(paymentStatusData) {
            const labels = paymentStatusData.map(item => item.name);
            const data = paymentStatusData.map(item => item.count);

            paymentStatusChart.data.labels = labels;
            paymentStatusChart.data.datasets[0].data = data;
            paymentStatusChart.update();
        }

        // Hàm cập nhật biểu đồ đường (đơn hàng)
        function updateLineChart(orderData) {
            const labels = orderData.map(item => `Tháng ${item.month}`);
            const data = orderData.map(item => item.total_orders);

            orderChart.data.labels = labels;
            orderChart.data.datasets[0].data = data;
            orderChart.update();
        }
    </script>
@endsection
