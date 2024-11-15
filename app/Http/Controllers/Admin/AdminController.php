<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\PaymentStatus;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        // Thống kê tổng số sản phẩm, danh mục, đơn hàng và người dùng
        $productsCount = Product::count();
        $categoryCount = Category::count();
        $orderCount = Order::count();
        $userCount = User::count();

        //Biểu đồ Cột
        // Thống kê doanh thu theo tháng (tổng tiền đơn hàng theo tháng)
        $monthlyRevenue = DB::table('orders')
            ->select(DB::raw('YEAR(created_at) as year'), DB::raw('MONTH(created_at) as month'), DB::raw('SUM(total_price) as total_revenue'))
            ->groupBy(DB::raw('YEAR(created_at)'), DB::raw('MONTH(created_at)'))
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();

        session(['monthlyRevenue' => $monthlyRevenue]);

        //Biểu đồ Đường
        // Thống kê tổng số đơn hàng theo tháng
        $monthlyOrderCount = DB::table('orders')
            ->select(DB::raw('YEAR(created_at) as year'), DB::raw('MONTH(created_at) as month'), DB::raw('COUNT(id) as total_orders'))
            ->groupBy(DB::raw('YEAR(created_at)'), DB::raw('MONTH(created_at)'))
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();

        //Biểu đồ Tròn
        // Thống kê trạng thái thanh toán
        $paymentStatusCounts = DB::table('payment_statuses')
            ->select('name', DB::raw('COUNT(*) as count'))
            ->groupBy('name')
            ->orderByDesc('count')
            ->get();

        // Tạo mảng labels và data để truyền vào view cho trạng thái thanh toán
        $labels = $paymentStatusCounts->pluck('name')->toArray();
        $data = $paymentStatusCounts->pluck('count')->toArray();

        // Truyền tất cả dữ liệu vào view
        return view('admin.home', compact('productsCount', 'categoryCount', 'orderCount', 'userCount', 'monthlyRevenue', 'monthlyOrderCount', 'paymentStatusCounts', 'labels', 'data'));
    }
}
