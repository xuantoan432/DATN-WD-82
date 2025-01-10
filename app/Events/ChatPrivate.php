<?php

namespace App\Events;

use App\Models\Chat;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class ChatPrivate implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(
        public User $userSend,
        public User $userReceiver,
        public Chat $chat,
    )
    {
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('chat.private.' . $this->userSend->id . '.' . $this->userReceiver->id)
        ];
    }

    public function broadcastWith()
    {
        $userSend = [
            'id' => $this->userSend->id,
            'name' => $this->userSend->name,
            'avata' => $this->userSend->avatar ? Storage::url($this->userSend->avatar) : asset('theme/client/assets/images/logos/avatar.jpg'),
        ];
        $userReceiver = [
            'id' => $this->userReceiver->id,
            'name' => $this->userReceiver->name,
            'avata' => $this->userReceiver->avatar ? Storage::url($this->userReceiver->avatar) : asset('theme/client/assets/images/logos/avatar.jpg'),
        ];
        return [
            'message' => $this->chat->message,
            'userSend' => $userSend,
            'userReceiver' => $userReceiver,
            'created_at' => $this->chat->created_at->isToday() ? $this->chat->created_at->format('g:i A') . ', Today' : $this->chat->created_at->format('g:i A, d M Y'),
        ];
    }
}
