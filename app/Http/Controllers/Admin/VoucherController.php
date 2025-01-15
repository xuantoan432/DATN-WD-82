<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;

class VoucherController extends Controller
{
    /**
     * Display a listing of the vouchers.
     */
    public function index()
    {
        $vouchers = Voucher::latest()->get();
        return view('admin.voucher.index', compact('vouchers'));
    }

    /**
     * Show the form for creating a new voucher.
     */
    public function create()
    {
        return view('admin.voucher.create');
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
        // dd($request->all());
        $voucherData['start_date'] = date("Y-m-d H:i:s", strtotime($request -> start_date));
        $voucherData['end_date'] = date("Y-m-d H:i:s", strtotime($request -> end_date));
        $voucherData['user_id'] = auth()->id();
      $voucher=   Voucher::create($voucherData);
        $data = [
            'code' => $voucher->code,


        ];
        \App\Events\VoucherSuccess::dispatch($data);

        return redirect()->route('admin.vouchers.index')->with('success', 'Thêm voucher thành công');
    }

    /**
     * Show the form for editing the specified voucher.
     */
    public function edit(Voucher $voucher)
    {

        return view('admin.voucher.edit', compact('voucher'));
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

    return redirect()->route('admin.vouchers.index')->with('success', 'Cập nhật voucher thành công');
}


    /**
     * Remove the specified voucher from storage.
     */
    public function destroy(Voucher $voucher)
    {
        $voucher->delete();

        return redirect()->route('admin.vouchers.index')->with('success', 'Xóa voucher thành công');
    }
}
