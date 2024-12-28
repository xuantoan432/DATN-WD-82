<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;

class OrderDetailController extends Controller
{
    public function orderDetail(Request $request, string $orderCode)
    {
        $order = Order::query()->with('orderDetails.productVariant.product')->where('order_code', $orderCode)->first();
        if(!$order){
            return back();
        }
        $orderDetails = $order->orderDetails;
        return view('client.profile.components.order-detail', compact('orderDetails'));
    }

    public function cancelOrderDetail($id){
        $orderDetail = OrderDetail::findorFail($id);
        $orderDetail->update(['status' => OrderDetail::CANCELLED]);

        return back()->with('success', 'Bạn hủy đơn hàng thành công!');
    }
}
