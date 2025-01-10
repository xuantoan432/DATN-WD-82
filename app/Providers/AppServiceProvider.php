<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Chat;
use App\Models\Notification;
use App\Models\OrderDetail;
use App\Models\Post;
use App\Models\User;
use Illuminate\Pagination\Paginator;
use App\View\Components\Client\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        Paginator::useBootstrapFive();
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::share('categories', Category::with('products')
        ->orderByDesc('id')
        ->limit(10)->get());
        Blade::component('comment', Comment::class);
         // thông báo
        View::composer('admin.layouts.partials.header', function ($view) {

                $notifications = Notification::where([['receiver_type', 'admin'] , ['status', 'pending']])->get();
                $notification = Notification::where('receiver_type', 'admin')
                ->orderByDesc('id')
                ->get();


                $view->with('notifications', $notifications);
                $view->with('notification', $notification);
        });
        View::composer('seller.layouts.partials.header', function ($view) {

            $sellerId = Auth::user()->seller->id;
            $notificationOrders = Notification::with(['notifiable' => function ($query) use ($sellerId) {
                $query->where('seller_id', $sellerId);
            }])
                ->where([
                    ['receiver_type', 'seller'],
                    ['status', 'pending'],
                    ['notifiable_type', OrderDetail::class],
                ])
                ->orderByDesc('id')
                ->get();
            $notifications = Notification::query()
                ->where([
                    ['receiver_type', 'seller-' . $sellerId],
                    ['status', 'pending'],
                    ['notifiable_type', '<>', OrderDetail::class],
                ])
                ->orderByDesc('id')
                ->get();

            $view->with('notificationOrders', $notificationOrders);
            $view->with('notifications', $notifications);
        });
        View::composer('seller.chat.sidebar', function ($view) {
            $senderUsers = Chat::query()
                ->where('user_receive_id', auth()->id()) // Lọc những tin nhắn mà bạn là người nhận
                ->select('user_send_id') // Chỉ lấy cột user_send_id để đảm bảo hiệu năng
                ->distinct() // Chỉ lấy các giá trị duy nhất
                ->with('sender:id,name,avatar') // Lấy thông tin người gửi qua quan hệ sender
                ->get();
            $view->with('senderUsers', $senderUsers);
        });
    }
}
