<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Mail\resetPassWord;
use Illuminate\Support\Facades\Mail;

class ForgotPasswordController extends Controller
{
    public  function  showFormForgotPassword()
    {
        return view('client.auth.forgot-password');
    }
    public  function  sendMailPassword(Request $request)
    {
        $request->validate(["email" => "required|email"]);
        $user = User::where("email", $request->email)->first();

        if (empty($user)) {
            return redirect()->back()->with('err', $request->email . ' Email này chưa được đăng ký trong hệ thống');
        }
        $token = Str::random(10);
        DB::table('password_reset_tokens')->updateOrInsert(['email' => $request->email], [
            'email' => $request->email,
            'token' => $token,
            'created_at' => now(),
        ]);

        Mail::to($request->email)->send(new resetPassWord($user, $token));

        return redirect()->back() -> with('msg' , 'Vui lòng check Email để lấy lại mật khẩu ');
    }
}
