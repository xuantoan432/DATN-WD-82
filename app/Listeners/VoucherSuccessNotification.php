<?php

namespace App\Listeners;

use App\Events\VoucherSuccess;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class VoucherSuccessNotification implements ShouldQueue
{



    public function handle(VoucherSuccess $event): void
    {
        $data = $event->voucherData;
        $users = User::pluck('email');
        foreach ($users as $email) {
            \Illuminate\Support\Facades\Mail::send('admin.voucher.voucher_notification', $data,
             function (\Illuminate\Mail\Message $message) use ($email) {
                $message->from('toannxph44181@fpt.edu.vn', 'admin');

                $message->to($email);
                $message->subject(' Mã giảm giá mới');
            });
        }
    }
}
