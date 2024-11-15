<script src="{{ asset('theme/admin/assets/js/bootstrap.bundle.min.js') }}"></script>

<!--plugins-->
<script src="{{ asset('theme/admin/assets/js/jquery.min.js') }}"></script>
<!--plugins-->
<script src="{{ asset('theme/admin/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
<script src="{{ asset('theme/admin/assets/plugins/metismenu/metisMenu.min.js') }}"></script>
@yield('js_new')

<script src="{{ asset('theme/admin/assets/plugins/simplebar/js/simplebar.min.js') }}"></script>
<script src="{{ asset('theme/admin/assets/js/main.js') }}"></script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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
                labels: @json($labels),  <!-- Truyền mảng labels từ controller vào JavaScript -->
                datasets: [{
                    data: @json($data),  <!-- Truyền mảng data từ controller vào JavaScript -->
                    backgroundColor: ['#FF5733', '#FFBD33', '#75FF33', '#33FFBD', '#3375FF'],  <!-- Màu sắc cho từng phần của biểu đồ -->
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,  // Giữ tỷ lệ giữa chiều rộng và chiều cao
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            font: {
                                size: 12  // Điều chỉnh font size của legend
                            }
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.label + ': ' + tooltipItem.raw + ' lần';  // Hiển thị tooltip với số lượng
                            }
                        }
                    }
                }
            }
        });
    });

    document.addEventListener("DOMContentLoaded", function () {
        // Lấy dữ liệu từ controller
        const monthlyOrderData = @json($monthlyOrderCount);  // Truyền dữ liệu từ controller vào JavaScript

        // Xử lý dữ liệu cho biểu đồ
        const labels = monthlyOrderData.map(order => 'Tháng'+String(order.month).padStart(2, '0'));
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
</script>
