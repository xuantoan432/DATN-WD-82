<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SellerApplicationSubmitted extends Notification
{
    use Queueable;

    public function __construct()
    {
        //
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Xác thực tài khoản thành công')
                    ->greeting('Xin chào ' . $notifiable->name)
                    ->line('Tài khoản của bạn đã được xác thực thành công.')
                    ->line('Bạn có thể đăng nhập và bắt đầu sử dụng các tính năng dành cho seller.')
                    ->action('Đăng nhập', url('/login'))
                    ->line('Cảm ơn bạn đã sử dụng dịch vụ của chúng tôi!');
    }
}
