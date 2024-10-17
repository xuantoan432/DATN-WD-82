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

        // $credentials = $request->validate([
        //     'email' => ['required', 'email'],
        //     'password' => ['required'],
        // ]);

        // if (Auth::attempt($credentials)) {
        //     $request->session()->regenerate();

        //     return redirect()->intended('/');
        // }
        // return back()->withErrors([
        //     'email' => 'The provided credentials do not match our records.',
        // ])->onlyInput('email');
        /////////////////////////////////////////////////
        // $request->validate([
        //     'email' => 'required|email',
        //     'password' => 'required|min:6',
        // ]);

        // $credentials = $request->only('email', 'password');
        // $remember = $request->has('remember');

        // if (Auth::attempt($credentials, $remember)) {
        //     return redirect()->intended('/');
        // }

        // return redirect()->back()->withErrors([
        //     'email' => 'Thông tin đăng nhập không chính xác.',
        // ])->withInput();
        ///////////////////////////////////////////


        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->hasRole(1)) {
                return redirect()->route('seller');
            }
            return redirect()->route('index');
        }
        return back()->withErrors([
            'email' => 'Email không tồn tại, vui lòng đăng ký tài khoản!',
        ]);
    }
}
