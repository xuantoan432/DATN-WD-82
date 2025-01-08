<?php

namespace App\Events;

use App\Models\Notification;
use App\Models\Review;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ReviewNotifycation implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(
        public Notification $notification,
        public Review $review,
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
        return new PrivateChannel("seller.{$this->review->product->seller_id}");
    }

    public function broadcastWith()
    {
        return [
            'title' => $this->notification['title'],
            'message' => $this->notification['message'],
            'url' => route('seller.reviews.edit', $this->review->id),
            'avatar' => asset('theme/admin/assets/images/apps/review.png'),
            'time' => $this->notification['created_at']->diffForHumans(),
        ];
    }
}
