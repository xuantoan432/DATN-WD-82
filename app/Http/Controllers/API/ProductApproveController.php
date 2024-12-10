<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductApproveController extends Controller
{

    public function index()
    {

    }


    public function store(Request $request)
    {

    }


    public function show(string $id)
    {
        //
    }


    public function update(Request $request,  $id)
    {
        $product = Product::findOrFail($id);
        $check = false ;

        if ($request->status == "duyet") {

            $product->update([
                'is_verified' => 1,
            ]);
            $thongbao =  $product->notifications()->create([
                'title' => 'Sản phẩm của bạn được phê duyệt',
                   'message' => 'Chấp nhận sản phẩm được đăng bán ' ,
                  'receiver_type' => 'seller',
            ]);
            $check = true;
        }
        if ($request->status == 'tuchoi') {
            $product->update([
                'is_verified' => 2,
            ]);
            $thongbao =  $product->notifications()->create([
                'title' => 'Sản phẩm của bạn không được chập thuận ',
                   'message' => $request->lido ,
                  'receiver_type' => 'seller',
            ]);
            $check = true;
        }

       if ( $check ) {
        return response()->json([
            'status'=>  'Thành công',

        ] , 200 );
       } else {
         return response()->json([
            'status'=>  $request->all(),
         ] ,500);
       }
    }


    public function destroy(string $id)
    {
        //
    }
}
