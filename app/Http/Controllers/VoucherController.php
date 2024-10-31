<?php

namespace App\Http\Controllers\seller;

use App\Http\Controllers\Controller;
use App\Models\Voucher;
use Illuminate\Http\Request;

class VoucherController extends Controller
{
    /**
     * Display a listing of the vouchers.
     */
    public function index()
    {
        $vouchers = Voucher::latest()->get(); 
        return view('seller.voucher.index', compact('vouchers'));
    }

    /**
     * Show the form for creating a new voucher.
     */
    public function create()
    {
        return view('seller.voucher.create');
    }

    /**
     * Store a newly created voucher in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|string|max:255|unique:vouchers,code',
            'discount_type' => 'required|in:percentage,fixed',
            'discount_value' => 'required|numeric|min:0',
            'max_discount_amount' => 'nullable|numeric|min:0',
            'min_order_value' => 'nullable|numeric|min:0',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'usage_limit' => 'nullable|integer|min:1',
            'usage_type' => 'required|boolean',
            'usage_per_customer' => 'nullable|integer|min:1',
        ]);
        $voucherData = $request->all();
        $voucherData['user_id'] = auth()->id();
        Voucher::create($request->all());

        return redirect()->route('seller.vouchers.index')->with('success', 'Thêm voucher thành công');
    }

    /**
     * Show the form for editing the specified voucher.
     */
    public function edit(Voucher $voucher)
    {
        
        return view('seller.voucher.edit', compact('voucher'));
    }

    /**
     * Update the specified voucher in storage.
     */
    public function update(Request $request, Voucher $voucher)
{
    $request->validate([
        'code' => 'required|string|max:255|unique:vouchers,code,' . $voucher->id,
        'discount_type' => 'required|in:percentage,fixed',
        'discount_value' => 'required|numeric|min:0',
        'max_discount_amount' => 'nullable|numeric|min:0',
        'min_order_value' => 'nullable|numeric|min:0',
        'start_date' => 'required|date',
        'end_date' => 'required|date|after_or_equal:start_date',
    ]);

    $voucher->update($request->only([
        'code', 
        'discount_type', 
        'discount_value', 
        'max_discount_amount', 
        'min_order_value', 
        'start_date', 
        'end_date'
    ]));

    return redirect()->route('seller.vouchers.index')->with('success', 'Cập nhật voucher thành công');
}


    /**
     * Remove the specified voucher from storage.
     */
    public function destroy(Voucher $voucher)
    {
        $voucher->delete();

        return redirect()->route('seller.vouchers.index')->with('success', 'Xóa voucher thành công');
    }
}
