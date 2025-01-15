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
            $request->session()->regenerate();
            if ($user->hasRole(1)) {
                return redirect('/admin');
            }
            return redirect()->intended('/');
        }
        return back()->withErrors([
            'email' => 'Email hoặc mật khẩu không chính xác, vui lòng nhập lại!',
        ]);
    }

    public function logout(){
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect('/');
    }
}
