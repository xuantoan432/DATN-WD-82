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
    public function index(Request $request)
    {
        // Thống kê tổng số sản phẩm, danh mục, đơn hàng và người dùng
        $productsCount = Product::count();
        $categoryCount = Category::count();
        $orderCount = Order::count();
        $userCount = User::count();

        $year = $request->get('year', now()->year);

        /// Biểu đồ Cột: Thống kê doanh thu theo tháng của năm
        $monthlyRevenue = DB::table('orders')
            ->select(DB::raw('YEAR(created_at) as year'), DB::raw('MONTH(created_at) as month'), DB::raw('SUM(total_price) as total_revenue'))
            ->whereYear('created_at', $year)
            ->groupBy(DB::raw('YEAR(created_at)'), DB::raw('MONTH(created_at)'))
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();

        session(['monthlyRevenue' => $monthlyRevenue]);

        // Biểu đồ Đường: Thống kê tổng số đơn hàng theo tháng của năm
        $monthlyOrderCount = DB::table('orders')
            ->select(DB::raw('YEAR(created_at) as year'), DB::raw('MONTH(created_at) as month'), DB::raw('COUNT(id) as total_orders'))
            ->whereYear('created_at', $year)
            ->groupBy(DB::raw('YEAR(created_at)'), DB::raw('MONTH(created_at)'))
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();

        // Biểu đồ Tròn: Thống kê trạng thái thanh toán của năm
        $paymentStatusCounts = DB::table('payment_statuses')
            ->select('name', DB::raw('COUNT(*) as count'))
            ->join('orders', 'orders.payment_status_id', '=', 'payment_statuses.id')
            ->whereYear('orders.created_at', $year)
            ->groupBy('name')
            ->orderByDesc('count')
            ->get();

        $labels = $paymentStatusCounts->pluck('name')->toArray();
        $data = $paymentStatusCounts->pluck('count')->toArray();
        // dd($labels, $data);

        // Truyền tất cả dữ liệu vào view
        return view('admin.home', compact('productsCount', 'categoryCount', 'orderCount', 'userCount', 'monthlyRevenue', 'monthlyOrderCount', 'paymentStatusCounts', 'labels', 'data','year'));
    }

    public function getStatisticsByYear(Request $request)
    {
        $year = $request->input('year', date('Y')); // Lấy năm từ request

        // Lấy dữ liệu thống kê theo năm
        $monthlyRevenue = $this->getMonthlyRevenue($year);
        $monthlyOrderCount = $this->getMonthlyOrderCount($year);
        $paymentStatusCounts = $this->getPaymentStatusCounts($year);

        // Trả về dữ liệu JSON
        return response()->json([
            'monthlyRevenue' => $monthlyRevenue,
            'monthlyOrderCount' => $monthlyOrderCount,
            'paymentStatusCounts' => $paymentStatusCounts,
        ]);
    }

    // Hàm phụ: Thống kê doanh thu theo tháng của năm
    private function getMonthlyRevenue($year)
    {
        return DB::table('orders')
            ->select(DB::raw('MONTH(created_at) as month'), DB::raw('SUM(total_price) as total_revenue'))
            ->whereYear('created_at', $year)
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->orderBy('month', 'asc')
            ->get();
    }

    // Hàm phụ: Thống kê tổng số đơn hàng theo tháng của năm
    private function getMonthlyOrderCount($year)
    {
        return DB::table('orders')
            ->select(DB::raw('MONTH(created_at) as month'), DB::raw('COUNT(id) as total_orders'))
            ->whereYear('created_at', $year)
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->orderBy('month', 'asc')
            ->get();
    }

    // Hàm phụ: Thống kê trạng thái thanh toán của năm
    private function getPaymentStatusCounts($year)
    {
        return DB::table('payment_statuses')
            ->select('name', DB::raw('COUNT(*) as count'))
            ->join('orders', 'orders.payment_status_id', '=', 'payment_statuses.id')
            ->whereYear('orders.created_at', $year)
            ->groupBy('name')
            ->orderByDesc('count')
            ->get();
    }
}
