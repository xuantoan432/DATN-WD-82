<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\User;
use Illuminate\Http\Request;
use App\Events\ChatPrivate;

class ChatPrivateController extends Controller
{
    public function listMessagePrivate(Request $request){
        $user_send_id = $request->userSendId;
        $user_receiver = $request->userReceiverID;

        $listMessage = Chat::query()
            ->with([
                'sender:id,name,avatar',
                'receiver:id,name,avatar'
            ])
            ->where(function ($query) use ($user_send_id, $user_receiver) {
                $query->where('user_send_id', $user_send_id)
                    ->where('user_receive_id', $user_receiver);
            })
            ->orWhere(function ($query) use ($user_send_id, $user_receiver) {
                $query->where('user_send_id', $user_receiver)
                    ->where('user_receive_id', $user_send_id);
            })
            ->orderByDesc('created_at')
            ->limit(50)
            ->get();
        return response()->json($listMessage);
    }
    public function messagePrivate($userID, Request $request){
        $data = [
            'message' => $request->message,
            'user_send_id' => $request->userSendId,
            'user_receive_id' => $userID
        ];
        $chat = Chat::create($data);
        broadcast(new ChatPrivate(User::query()->find($request->userSendId), User::query()->find($userID), $chat));
        return response()->json([
            'message' => 'Thành công',
        ]);
    }
}
