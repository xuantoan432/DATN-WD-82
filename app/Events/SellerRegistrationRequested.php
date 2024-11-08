<?php

namespace App\Events;

use App\Models\Seller;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SellerRegistrationRequested implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $seller;

    public function __construct(Seller $seller)
    {
        $this->seller = $seller;
    }

    public function broadcastOn()
    {
        return new Channel('seller');
    }

    public function broadcastWith()
    {
        return [
            'id' => $this->seller->id,
            'user_id' => $this->seller->user_id,
            'user_name' => $this->seller->user->name,
            'store_name' => $this->seller->store_name,
            'email' => $this->seller->store_email,
            'description' => $this->seller->store_description,
        ];
    }
}
