<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    function showLogInForm()
    {
        return view("client.auth.login");
    }

    function logIn(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);


        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->hasRole(1)) {
                return redirect('/admin');
            }
            return redirect()->intended('/');
        }
        return back()->withErrors([
            'email' => 'Email không tồn tại, vui lòng đăng ký tài khoản!',
        ]);
    }

    public function logout(){
        Auth::logout();
        \request() -> session() -> invalidate();

        return redirect('/');
    }
}
