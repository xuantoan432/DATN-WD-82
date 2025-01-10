<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\User;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index(){
        return view('seller.chat.index');
   }

   public function chatPriavte(Request $request, $userId)
   {
       $userReceive = User::query()->find($userId);
       $user_send_id = auth()->id();
       $listMessages = Chat::query()
           ->where(function ($query) use ($user_send_id, $userId) {
               $query->where('user_send_id', $user_send_id)
                   ->where('user_receive_id', $userId);
           })
           ->orWhere(function ($query) use ($user_send_id, $userId) {
               $query->where('user_send_id', $userId)
                   ->where('user_receive_id', $user_send_id);
           })
           ->orderByDesc('created_at')
           ->limit(50)
           ->get();
       return view('seller.chat.chat-private', [
           'userReceive' => $userReceive,
           'userSend' => auth()->user(),
           'listMessages' => $listMessages
       ]);
   }
}
