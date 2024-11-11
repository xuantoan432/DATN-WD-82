<?php

namespace App\Http\Controllers\Admin;

use App\Events\SellerApproved;
use App\Events\SellerRegistrationRequested;
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
        $seller = Seller::with('user')->where('is_verified', false)->get();

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


        broadcast(new SellerApproved($seller->user_id))->toOthers();
        // $seller->notify(new SellerApplicationSubmitted());

        return redirect()->back()->with('success', 'Seller approved successfully.');
    }

    // Xử lý từ chối seller
    public function reject($id)
    {
        $seller = Seller::findOrFail($id);
        $seller->delete();

        return redirect()->back()->with('success', 'Seller rejected successfully.');
    }
}
