<?php

namespace App\Http\Controllers\Admin;

use App\Events\SellerApproved;
use App\Events\SellerRegistrationRequested;
use App\Events\SellerRejected;
use App\Http\Controllers\Controller;
use App\Mail\SellerApprovedNotification;
use App\Models\Seller;
use App\Notifications\SellerApplicationSubmitted;
use App\Notifications\SellerApproved as NotificationsSellerApproved;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AdminUserApprovalController extends Controller
{
    public function index()
    {
        $seller = Seller::with('user', 'address.province', 'address.ward', 'address.district')->where('is_verified', false)->orderByDesc('id')->get();
        return view('Admin.seller.verifySeller', compact('seller'));
    }

    // Xử lý phê duyệt seller
    public function approve($id)
    {
        $seller = Seller::findOrFail($id);
        $user = $seller->user;
        $user->roles()->sync([2, 3]);
        $seller->is_verified = true;
        $seller->save();

        // if (Auth::check() && Auth::user()->id === $seller->user_id) {
        //     return redirect()->route('home.index')->with('success', 'Your account has been approved!');
        // }


        event(new SellerApproved($seller->user_id));
        // $seller->notify(new SellerApplicationSubmitted());

        return redirect()->back()->with('success', 'Người bán được phê duyệt thành công.');
    }

    // Xử lý từ chối seller
    public function reject($id)
    {
        $seller = Seller::findOrFail($id);
        $seller->is_verified = false;
        $seller->save();
        $user = $seller->user;
        $user->roles()->sync([3]);
        $seller->delete();

        event(new SellerRejected($seller->user_id, 'Yêu cầu đăng ký của bạn đã bị từ chối vì không đáp ứng điều kiện.'));


        return redirect()->back()->with('success', 'Từ chối người bán thành công.');
    }
}
