<?php

namespace App\Http\Controllers\Client\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Voucher;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VoucherController extends Controller
{
    public function applyVoucher(Request $request)
    {
        $request->validate([
            'coupon_code' => 'required|string',
            'total' => 'required|numeric|min:0',
            'user_id' => 'nullable|integer|exists:users,id',
            'discount_value' => 'nullable',
            'voucher_previous' => 'nullable'
        ]);
        $couponCode = $request->input('coupon_code');
        $cartTotal = $request->input('total');
        $userId = $request->input('user_id');
        $discountValue = $request->input('discount_value');
        $voucher_previous = $request->input('voucher_previous');
        $now = Carbon::now()->format('Y-m-d H:i:s');

        $voucher = Voucher::where('code', $couponCode)
            ->where('status', 'active')
            ->where('start_date', '<=', [$now])
            ->where('end_date', '>=', [$now])
            ->first();
        if (!$voucher) {
            return response()->json([
                'success' => false,
                'message' => 'Voucher không hợp lệ hoặc đã hết hạn'
            ]);
        }

        if($voucher->id == $voucher_previous){
            return response()->json([
                'success' => false,
                'message' => 'Voucher này đang sử dụng'
            ]);
        }
        if ($cartTotal < $voucher->min_order_value) {
            return response()->json([
                'success' => false,
                'message' => 'Giá trị đơn hàng không đủ để áp dụng voucher'
            ]);
        }

        if ($voucher->usage_limit <= 0) {
            return response()->json([
                'success' => false,
                'message' => 'Voucher đã hết lượt sử dụng'
            ]);
        }

        if($voucher_previous){
            $previousVoucher = Voucher::find($voucher_previous);
            if ($previousVoucher && $previousVoucher->usage_type != 1 && $voucher->usage_type != 1) {
                return response()->json([
                    'success' => false,
                    'message' => 'Voucher không thể áp dụng cùng với các voucher khác'
                ]);
            }
        }

        $usageCount = $userId ? User::find($userId)->userVouchers()->where('voucher_id', $voucher->id)->count() : 0;
        if ($usageCount >= $voucher->usage_per_customer) {
            return response()->json([
                'success' => false,
                'message' => 'Bạn đã sử dụng voucher này quá số lần cho phép'
            ]);
        }

        $discount = 0;
        if ($voucher->discount_type == 'percentage') {
            $discount = ($cartTotal * $voucher->discount_value) / 100;
        } elseif ($voucher->discount_type == 'fixed') {
            $discount = $voucher->discount_value;
        }


        if ($voucher->max_discount_amount) {
            $discount = min($discount, $voucher->max_discount_amount);
        }
        $discount += $discountValue;

        $this->updateVoucherApply($voucher->id, $userId);

        $totalAfterDiscount = $cartTotal - $discount;
        return response()->json([
            'success' => true,
            'discount' => $discount,
            'total_after_discount' => $totalAfterDiscount,
            'voucher_id' => $voucher->id,
        ]);
    }
    public function updateVoucherApply($voucherId, $user_id){
        $voucher =  Voucher::find($voucherId);
        $voucher->usage_limit -= 1;
        $voucher->save();

        $user = User::find($user_id);
        $user->userVouchers()->attach($voucher->id);
    }
}
