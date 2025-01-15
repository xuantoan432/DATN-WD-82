<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Category;

use App\Models\OrderDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SellerController extends Controller
{
    public function index()
    {
        $seller = Auth::user()->seller;
        $products = $seller->products;
        $odder = OrderDetail::query()->where('seller_id' , $seller->id) ->orderBy('id' , 'desc') ->get();

        $categories = [];
        // lấy sản phẩm thuộc danh mục , số lượng sản phẩm chiếm  , ...
        $categoryIds = $products->pluck('category_id')->unique()->values();
        $uniqueCategories = Category::whereIn('id', $categoryIds)->get();
        foreach ($uniqueCategories as $category) {
            $data = count($category->products->where('seller_id' ,$seller->id ));

            $totalProductsCount = count($products);

            $percent = ($totalProductsCount > 0) ? ($data * 100) / $totalProductsCount : 0;
            $categories[] = [
                'name' => $category->name,
                'id' => $category->id,
                'percent' => round($percent, 2), // Làm tròn tới 2 chữ số sau dấu phẩy,
                'quantity' => $data,
            ];
        }
        // lấy ra oder ngày hôm nay và ss sánh ngày hôm qua
            // đơn hàng
        $ordersYesterday = $seller->oderDetails()->whereDate('created_at', Carbon::yesterday())->get();
        $ordersToday =  $seller->oderDetails()->whereDate('created_at', Carbon::today())->get();
        $countYesterday = count($ordersYesterday) ;
        $countToday = count($ordersToday);
        $percentOder = $countYesterday > 0 ? percent($countToday,$countYesterday)  : 0 ;
        $ordersByMinute = $seller->oderDetails()
            ->selectRaw('DATE_FORMAT(created_at, "%h:%i %p") as time, COUNT(*) as total_orders , SUM(price) as total_price')
            ->whereDate('created_at', Carbon::today())
            ->groupBy('time')
            ->orderBy('time')
            ->get();
        // doanh thu
        $revenue = $seller->oderDetails()
            ->whereDate('created_at', Carbon::today())
            ->sum('price');
        $revenuey = $seller->oderDetails()
            ->whereDate('created_at', Carbon::yesterday())
            ->sum('price');
        $percentPrice = $countYesterday > 0 ? percent($revenue,$revenuey)  : 0 ;
        /// theo ngày
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();
        $currentYear = Carbon::now()->year;
        $daysOfWeek = [
            1 => 'Chủ nhật',
            2 => 'Thứ hai',
            3 => 'Thứ ba',
            4 => 'Thứ tư',
            5 => 'Thứ năm',
            6 => 'Thứ sáu',
            7 => 'Thứ bảy',
        ];
        $weeklyStats = $seller->oderDetails()
            ->selectRaw("DAYOFWEEK(created_at) as weekday, COUNT(*) as total_orders ,  SUM(price) as total_price ")
            ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
            ->groupBy('weekday')
            ->orderBy('weekday')
            ->get()
              ->keyBy('weekday');
        $weeklyStatsFull = collect($daysOfWeek)->map(function ($dayName, $weekday) use ($weeklyStats) {
            return [
                'weekday' => $dayName,
                'total_price' => $weeklyStats[$weekday]->total_price ?? 0,
                'total_orders' => $weeklyStats[$weekday]->total_orders ?? 0,
            ];
        })->values()->toArray();
            // theo tháng
        $monthlyStats = $seller->oderDetails()
            ->selectRaw("MONTH(created_at) as month, COUNT(*) as total_orders , SUM(price) as total_price ")
            ->whereYear('created_at', $currentYear)
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->keyBy('month');

        $monthlyStatsFull = collect(range(1, 12))->map(function ($month) use ($monthlyStats) {
            $months = [
                1 => 'Tháng 1',
                2 => 'Tháng 2',
                3 => 'Tháng 3',
                4 => 'Tháng 4',
                5 => 'Tháng 5',
                6 => 'Tháng 6',
                7 => 'Tháng 7',
                8 => 'Tháng 8',
                9 => 'Tháng 9',
                10 => 'Tháng 10',
                11 => 'Tháng 11',
                12 => 'Tháng 12',
            ];

            return [
                'month' => $months[$month],
                'total_price' => $monthlyStats[$month]->total_price ?? 0,
                'total_orders' => $monthlyStats[$month]->total_orders ?? 0,
            ];
        })->values()->toArray();
// theo tuần
        $startDate = Carbon::now()->startOfMonth(); // Ngày đầu tiên của tháng
        $endDate = Carbon::now()->endOfMonth();     // Ngày cuối cùng của tháng
        $tuan = [];
        for ($week = 1; $week <= 5; $week++) {
            // Tính toán ngày bắt đầu và ngày kết thúc của tuần
            $weekStart = $startDate->copy()->addWeeks($week - 1)->startOfWeek();
            $weekEnd = $weekStart->copy()->endOfWeek();

            // Nếu tuần kết thúc vượt quá ngày cuối tháng, điều chỉnh lại
            if ($weekEnd->gt($endDate)) {
                $weekEnd = $endDate;
            }

            // Thực hiện thống kê cho tuần này
            $weekData = $seller->oderDetails()
                -> whereBetween('created_at', [$weekStart, $weekEnd])
                ->sum('price');
            $weekData1 = $seller->oderDetails()
                -> whereBetween('created_at', [$weekStart, $weekEnd])
                ->count();

            // Thêm kết quả tuần vào mảng dữ liệu
            $tuan[] = [
                'tuan' => $week,

                'total_price' => $weekData ,
                'total_orders' => $weekData1,
            ];

            // Nếu tuần kết thúc đã vượt quá ngày cuối tháng thì dừng lại
            if ($weekEnd->eq($endDate)) {
                break;
            }
        }

/// theo năm
        $currentYear = Carbon::now()->year;
        $nam = [] ;
        $years = [$currentYear - 1, $currentYear, $currentYear + 1, $currentYear + 2, $currentYear + 3];
        foreach ($years as $year) {
            // Tính toán ngày bắt đầu và ngày kết thúc của năm
            $yearStart = Carbon::create($year, 1, 1)->startOfYear(); // Ngày đầu tiên của năm
            $yearEnd = $yearStart->copy()->endOfYear();                // Ngày cuối cùng của năm

            // Thực hiện thống kê cho năm này
            $yearData = $seller->oderDetails()-> whereBetween('created_at', [$yearStart, $yearEnd])
                ->count(); // Hoặc thay count() bằng sum() nếu bạn muốn tính tổng giá trị
            $yearData1 = $seller->oderDetails()-> whereBetween('created_at', [$yearStart, $yearEnd])
                ->sum('price');
            // Thêm kết quả năm vào mảng dữ liệu
            $nam[] = [
                'year' => $year,
                'total_orders' => $yearData ,
                'total_price' => $yearData1,
            ];
        }
        // dữ liệu truyền ra bảng thông kê
        $data = [
            "seller" => [
                "id" => $seller->id,
                "name" => $seller->store_name,
                "logo_shop" => $seller->logo_shop,
                "account_balance" => $seller->account_balance,
            ],
            "products" => [
                'category' => $categories,
                'pro' => $products
            ],
            "orders" => [
                'today' => $ordersToday,
                'yesterday' => $ordersYesterday ,
                'percentOder' => $percentOder,
                'ordersByMinute' => $ordersByMinute
            ],
            "revenue" => [
                'percent' => $revenue,
                'percentPrice' => $percentPrice ,
                'weeklyStats' => $weeklyStatsFull ,
                'monthlyStats' => $monthlyStatsFull ,
                'tuan' => $tuan,
                'nam' => $nam,
            ],
        ];


        return view('seller.home', compact('data' , 'odder'));
    }
}
