<?php

namespace App\Http\Controllers\Client\API;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddToCartController extends Controller
{
    public function checkVariant(Request $request)
    {
        $attributes = $request->input('selectedAttributes');

        $variant = \DB::table('product_variants as pv')
            ->join('product_variant_attributes as pva', 'pv.id', '=', 'pva.product_variant_id')
            ->where('pv.product_id', $request->input('productId'))
            ->where(function ($query) use ($attributes) {
                foreach ($attributes as $attributeId => $attributeValueId) {
                    $query->orWhere(function ($query) use ($attributeId, $attributeValueId) {
                        $query->where('pva.attribute_id', $attributeId)
                            ->where('pva.attribute_value_id', $attributeValueId);
                    });
                }
            })
            ->groupBy('pv.id')
            ->having(\DB::raw('COUNT(DISTINCT pva.attribute_id)'), '=', count($attributes))
            ->select('pv.*')
            ->first();

        return $variant;
    }

    public function checkQuantity(Request $request)
    {
        $quantity = $request->input('quantity');
        $cartId = $request->input('cartId');

        $cartItem = CartItem::query()->findOrFail($cartId);

        if ($quantity > 0 && $cartItem) {
            $productVariant = ProductVariant::find($cartItem->product_variant_id);
            if ($productVariant && $quantity <= $productVariant->stock_quantity) {
                $cartItem->update([
                    'quantity' => $quantity,
                ]);


                return response()->json([
                    'status' => 'success',
                    'message' => 'Sản phẩm không đủ số lượng.'
                ], 200);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Sản phẩm không đủ số lượng.'
                ], 422);
            }
        }
        return response()->json([
            'status' => 'error',
            'message' => 'Không tồn tại sản phẩm.'
        ], 400);
    }

    public function deleteItemCart(Request $request){
        $cartId = $request->input('cartId');
        $cartItem = CartItem::findOrFail($cartId);
        $cartItem->delete();
        return response()->json([
            'success' => true,
            'message' => 'Sản phẩm đã được xóa khỏi giỏ hàng.'
        ], 200);
    }
}
