<?php

namespace App\Http\Controllers\Auth;

use App\Events\SellerApproved;
use App\Events\SellerRegistrationRequested;
use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Role;
use App\Models\Seller;
use App\Models\User;
use App\Models\UserRole;
use App\Notifications\SellerApplicationSubmitted;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SellerRegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('client.auth.seller_register');
    }
    public function register(Request $request)

    {
        // Validate the input
        $validatedData = $request->validate([
            'store_name' => 'required|string|max:255',
            'store_email' => 'required|email|max:255|unique:sellers',
            'store_description' => 'required|string|max:1000',
            'address_line' => 'required|string|max:255',
            'province' => 'required|integer',
            'district' => 'required|integer',
            'ward' => 'required|integer',
        ]);


        $user = Auth::user();
        $seller =   Seller::create([
            'user_id' => $user->id,
            'store_name' => $validatedData['store_name'],
            'store_email' => $validatedData['store_email'],
            'store_description' => $validatedData['store_description'],
            'is_verified' => false,
        ]);
        $address = Address::create([
            'address_line' => $validatedData['address_line'],
            'province_id' => $validatedData['province'],
            'district_id' => $validatedData['district'],
            'ward_id' => $validatedData['ward'],
        ]);


        $user = User::findOrFail($user->id);
        if (!$user->roles()->where('role_id', 2)->exists()) {
            $user->roles()->attach(2);
        }
        broadcast(new SellerRegistrationRequested($seller))->toOthers();


        return redirect()->back()->with('message', 'Registration submitted. Awaiting admin approval.');


    }

}

