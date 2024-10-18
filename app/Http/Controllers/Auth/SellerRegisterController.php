<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class SellerRegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('client.auth.seller_register');
    }
    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15|regex:/^[0-9]+$/',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::query()->create($data);

           $user->roles()->attach(2); 
         return view('client.login');



}
}
