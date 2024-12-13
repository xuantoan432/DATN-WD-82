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

        $categories = Category::query()->limit(11)->get();

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
            'activeBanners' => $activeBanners,
            'categories' => $categories
        ]);

    }

    public function shop(Request $request)
    {
        $validated = $request->validate([
            'categories_id.*' => 'integer|exists:categories,id',
            'sellers_id.*' => 'integer|exists:sellers,id',
            'min-value' => 'numeric|min:0',
            'max-value' => 'numeric|min:0|gte:min-value',
            'searchProduct' => 'string|max:255',
            'sort_order' => 'in:price_asc,price_desc,rating,default',
        ]);

        $priceRange = Product::selectRaw('MAX(price) as maxPrice, MIN(price) as minPrice')->first();
        $maxPrice = $priceRange->maxPrice;
        $minPrice = $priceRange->minPrice;

        $topSellers = Seller::withCount('products')
            ->orderByDesc('products_count')
            ->limit(10)
            ->get();

        $topCategories = Category::withCount('products')
            ->orderByDesc('products_count')
            ->limit(10)
            ->get();

        $products = Product::where('is_verified', true)
            ->where('status', 'active')
            ->withAvg('reviews', 'star')
            ->filter($request->all())
            ->sort($request->input('sort_order'))
            ->paginate(15)
            ->appends($request->query());

        if ($request->ajax()) {
            $productsHtml = view('client.components.shop', compact('products'))->render();
            return response()->json(['productsHtml' => $productsHtml]);
        }

        return view('client.shop', [
            'products' => $products,
            'minPrice' => $minPrice,
            'maxPrice' => $maxPrice,
            'topSellers' => $topSellers,
            'topCategories' => $topCategories,
        ]);
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
