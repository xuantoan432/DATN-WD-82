<?php

namespace App\Http\Controllers\Client;
use App\Http\Controllers\Controller;
use App\Mail\ConTactFormMail;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    // Phương thức để hiển thị form liên hệ
    public function index()
    {
        return view('client.contact');  // Đảm bảo bạn có view 'contact.index' cho form liên hệ
    }

    // Phương thức để xử lý dữ liệu gửi từ form
    public function send(Request $request)
    {
        // Kiểm tra và xác thực dữ liệu đầu vào
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'message' => 'required|string|max:500',
        ]);

        // Lưu thông tin liên hệ vào cơ sở dữ liệu
        $contact = Contact::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'message' => $validated['message'],
        ]);

        // Lấy email người nhận từ file .env
        $recipientEmail = env('CONTACT_EMAIL'); // Lấy giá trị từ .env

        // Gửi email đến người nhận
        Mail::to($recipientEmail)->send(new ContactFormMail($contact));

        // Chuyển hướng hoặc trả về phản hồi
        return redirect()->route('contact')->with('success', 'Cảm ơn bạn đã gửi liên hệ!');
    }



}
