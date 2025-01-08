<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function index(){
        $sellerId = Auth::user()->seller->id;
        $reviews = Review::query()->with('product', 'user')->whereHas('product', function($query) use ($sellerId){
            $query->where('seller_id', $sellerId);
        })
            ->where('parent_id', 0)->orderByDesc('id')->get();
        return view('seller.reviews.index', compact('reviews'));
    }

    public function edit(Review $review){
        Carbon::setLocale('vi');
        $review->load('product.reviews', 'user', 'notifications');
        $review->notifications()->update(['status' => 'read']);
        $reviewRely = Review::query()->where('parent_id', $review->id)->first();
        return view('seller.reviews.edit', compact('review', 'reviewRely'));
    }

    public function store(Request $request){
        $request->validate([
            'product_id' => 'required',
            'user_id' => 'required',
            'parent_id' => 'required',
            'content' => 'required',
        ]);

        $reviewRely = Review::create($request->all());

        return back()->with([
            'reviewRely' => $reviewRely,
            'success' => 'Trả lời đánh giá thành công'
        ]);
    }
}
