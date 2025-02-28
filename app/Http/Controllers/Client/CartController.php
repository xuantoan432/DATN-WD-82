<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function showCart(){
        $cart = Cart::query()->where('user_id', Auth::id())->first();
        if ($cart) {
            $cartItems = $cart->cartItems()->with([
                'productVariant.product',
                'productVariant.attributes.attribute',
            ])->orderByDesc('id')->get();
        } else {
            // Nếu không có giỏ hàng, đặt $cartItems thành mảng rỗng
            $cartItems = collect([]);
        }
        return view('client.cart', compact( 'cartItems', 'cart'));
    }
    public function addToCart(Request $request)
    {
        $variantId = $request->input('product-variant-id');
        $quantity = $request->input('quantity');
        $userID = Auth::id();
        $productVariant = ProductVariant::query()->find($variantId);
        $cart = Cart::firstOrCreate(['user_id' => $userID]);
        $cartItem = CartItem::where('cart_id', $cart->id)
            ->where('product_variant_id', $variantId)
            ->first();

        if ($cartItem) {
            $newQuantity = $cartItem->quantity + $quantity;
            if($newQuantity > $productVariant->stock_quantity){
                return back()->with('error', 'số lượng trong giỏ hàng nhiều hơn số lượng tồn kho');
            }
            $cartItem->update(['quantity' => $cartItem->quantity + $quantity]);
        } else {
            CartItem::create([
                'cart_id' => $cart->id,
                'product_variant_id' => $variantId,
                'quantity' => $quantity,
            ]);
        }
        return redirect()->route('cart.show');
    }

    public function clearCart($cartId){
        $cart = Cart::query()->findOrFail($cartId);
        $cart->delete();
        return redirect()->route('cart.show');
    }
}
