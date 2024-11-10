<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //

    public function index()
    {
        $new_products = Product::orderBy('created_at','DESC')->limit(8)->get();
//        $sale_products = Product::orderBy('created_at','DESC')->where('price_sale','>',0)->limit(4)->get();
        $sell_products = Product::inRandomOrder()->limit(6)->get();
//        $best_sell = Product::orderBy('price_sale', 'DESC')->limit(4)->get();
//        $flash_sale = Product::orderBy('price_sale', 'ASC')->limit(12)->get();
        return view('client.index',[
            'new_products' => $new_products,
            'sale_products' => [],
            'sell_products' => $sell_products,
            'best_sell' => [],
            'flash_sale' => [],
        ]);
    }

    public function shop()
    {
        $new_products = Product::orderBy('created_at','DESC')->limit(6)->get();
        $sell_products = Product::inRandomOrder()->limit(6)->get();
        return view('client.shop',[
            'new_products' => $new_products,
            'sell_products' => $sell_products,]);
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

    public function compare()
    {
        return view('client.compaire');
    }

    public function becomeVendor()
    {
        return view('client.become-vendor');
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
