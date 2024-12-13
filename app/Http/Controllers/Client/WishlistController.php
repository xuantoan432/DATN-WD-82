<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function listWishlist()
    {
        $wishlistItems = Wishlist::where('user_id', Auth::id())->with('product')->get();
        return view('client.wishlist', compact('wishlistItems'));
    }

    public function addToWishlist(Request $request): JsonResponse
    {
        $userId = Auth::id();
        $productId = $request->input('product_id');

        if (!$productId) {
            return response()->json(['success' => false, 'message' => 'Sản phẩm không hợp lệ.']);
        }

        $existingWishlistItem = Wishlist::where('user_id', $userId)
            ->where('product_id', $productId)
            ->first();

        if ($existingWishlistItem) {
            return response()->json(['success' => false, 'message' => 'Sản phẩm đã có trong danh sách yêu thích.']);
        }

        Wishlist::create([
            'user_id' => $userId,
            'product_id' => $productId,
            'status' => 1
        ]);

        $productCount = Wishlist::where('user_id', $userId)->count();

        return response()->json(['success' => true, 'message' => 'Đã thêm sản phẩm vào danh sách yêu thích.', 'quantity' => $productCount]);
    }

    public function removeWishlist($id)
    {
        $userId = Auth::id();

        $wishlistItem = Wishlist::where('user_id', $userId)
            ->where('id', $id)
            ->first();

        if (!$wishlistItem) {
            return redirect()->route('wishlist.show')->with('error', 'Không tìm thấy sản phẩm trong danh sách yêu thích.');
        }

        $wishlistItem->delete();

        return redirect()->route('wishlist.show')->with('success', 'Đã xóa sản phẩm khỏi danh sách yêu thích.');
    }

    public function cleanWishlist()
    {
        $userId = Auth::id();

        Wishlist::where('user_id', $userId)->delete();

        return redirect()->route('wishlist.show')->with('success', 'Đã xóa tất cả sản phẩm khỏi danh sách yêu thích.');
    }
}
