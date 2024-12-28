<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $orderDetails = OrderDetail::query()->where('seller_id', $user->seller->id)->orderBy('created_at', 'desc')->get();
        return view('seller.order.index', compact('orderDetails'));
    }

    public function edit(OrderDetail $orderDetail)
    {
        $orderDetail->load(['order.address.details', 'order.user','notifications']);
        $orderDetail->notifications()->update(['status' => 'read']);
        $user = $orderDetail->order->address;
        return view('seller.order.edit', compact('orderDetail', 'user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,OrderDetail $orderDetail)
    {
        $newStatus = $request->input('status');

        // Validate trạng thái
        if (!OrderDetail::canTransition($orderDetail->status, $newStatus)) {
            return redirect()->back()->with('error', 'Chuyển trạng thái không hợp lệ');
        }

        // Cập nhật trạng thái
        $orderDetail->update(['status' => $newStatus]);

        return redirect()->back()->with('success', 'Trạng thái đơn hàng đã được cập nhật.');
    }

}
