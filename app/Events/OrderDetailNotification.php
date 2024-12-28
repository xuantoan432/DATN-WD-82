<?php

namespace App\Events;

use App\Models\Notification;
use App\Models\OrderDetail;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class OrderDetailNotification implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(
        public Notification $notification,
        public OrderDetail $orderDetail,
    )
    {
        //
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn()
    {
        return new PrivateChannel("seller.{$this->orderDetail->seller_id}");
    }

    public function broadcastWith()
    {
        return [
            'title' => $this->notification['title'],
            'message' => $this->notification['message'],
            'url' => route('seller.orders.edit', $this->orderDetail->id),
            'avatar' => asset('theme/admin/assets/images/apps/14.png'),
            'time' => $this->notification['created_at'],
            'orderDetail' => $this->orderDetail,
        ];
    }
}
