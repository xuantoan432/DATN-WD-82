<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Product;
use App\Models\Category;
use App\Models\Seller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //

    public function index()
    {
        $activeBanners = Banner::where('is_featured', 1)->get(); 

        $new_products = Product::where('is_verified', true)
            ->where('status', 'active')
            ->withAvg('reviews', 'star')
            ->orderBy('created_at', 'DESC')
            ->limit(8)
            ->get();

        $sale_products = Product::where('is_verified', true)
            ->where('status', 'active')
            ->withAvg('reviews', 'star')
            ->orderBy('created_at', 'DESC')
            ->limit(4)
            ->get();

        $sell_products = Product::where('is_verified', true)
            ->where('status', 'active')
            ->withAvg('reviews', 'star')
            ->orderBy('views', 'DESC')
            ->limit(6)
            ->get();

        $best_sell = Product::where('is_verified', true)
            ->where('status', 'active')
            ->withAvg('reviews', 'star')
            ->orderBy('price', 'ASC')
            ->limit(4)
            ->get();

        $flash_sale = Product::where('is_verified', true)
            ->where('status', 'active')
            ->withAvg('reviews', 'star')
            ->orderBy('price', 'ASC')
            ->limit(12)
            ->get();

        return view('client.index', [
            'new_products' => $new_products,
            'sale_products' => $sale_products,
            'sell_products' => $sell_products,
            'best_sell' => $best_sell,
            'flash_sale' => $flash_sale,
            'activeBanners' => $activeBanners
        ]);

    }

    public function shop(Request $request)
    {
        $topSellers = Seller::withCount('products')
            ->orderByDesc('products_count')
            ->limit(10)
            ->get();

        $topCategories = Category::withCount('products')
            ->orderByDesc('products_count')
            ->limit(10)
            ->get();

        $cats = Category::all();
        $seller = Seller::all();

        $query = Product::where('is_verified', true)
            ->where('status', 'active')
            ->withAvg('reviews', 'star');

        $checkCategoryId = $request->category_id ?? [];
        $checkSeller = $request->seller ?? [];

        if (count($checkCategoryId) > 0) {
            $query = $query->whereIn('category_id', $checkCategoryId);
        }

        if (count($checkSeller) > 0) {
            $query = $query->whereIn('seller_id', $checkSeller);
        }

        if ($request->searchProduct) {
            $query = $query->where('name', 'like', '%' . $request->searchProduct . '%');
        }

        $sort = $request->get('sort', 'default');
        switch ($sort) {
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            case 'rating':
                $query->orderByDesc('reviews_avg_star');
                break;
            default:
                $query->orderBy('created_at', 'desc'); 
                break;
        }

        $products = $query->paginate(16);

        return view('client.shop', compact(
            'products', 'cats', 'checkCategoryId', 
            'seller', 'checkSeller', 'topCategories', 
            'topSellers', 'sort'
        ));
    }

    public function productInfo()
    {
        return view('client.product-info');
    }

    public function contact()
    {
        return view('client.contact');
    }

    public function about()
    {
        return view('client.about');
    }

    public function cart()
    {
        return view('client.cart');
    }

    public function compaire()
    {
        return view('client.compaire');
    }
    public function policy()
    {
        return view('client.privacy');
    }


    public function flashSale()
    {
        return view('client.flash-sale');
    }

    public function createAccount()
    {
        return view('client.create-account');
    }

    public function login()
    {
        return view('client.login');
    }

    public function sellerSidebar()
    {
        return view('client.seller-sidebar');
    }
}
