<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{   
    public function index(){
        $orders = Order::paginate(15);
        return view('seller.order.index', compact('orders'));
    }
    public function show($id){
        $order = Order::with('product');
        return view('seller.order.show', compact('order'));
    }
}
