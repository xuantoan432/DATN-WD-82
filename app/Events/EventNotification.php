<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class EventNotification implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

     public $thongbao   ;
     public $user    ;
    public function __construct($thongbao , $user )
    {
        $this->thongbao = $thongbao;
        $this->user  = $user ;
    }

    public function broadcastOn()
    {
      return new Channel("thongbao");
    }
    public function broadcastWith()
    {
        if($this->thongbao['notifiable_type'] == 'App\Models\Product'){
            return [
                'title' => $this->thongbao['title'],
                'message'=> $this->thongbao['message'],
                'url'  => route('admin.phe-duyet.show' , $this->thongbao['notifiable_id']),
                'name' => $this->user['store_name'],
                'user_id' => $this->user['user_id'],
                'avatar' => $this->user['logo_shop'],
                'time' => $this->thongbao['created_at'],
            ];
        } else {
            return [
                'title' => $this->thongbao['title'],
                'url'  => 'dang test',
                'message'=> $this->thongbao['message'],
                'name'=> $this->user['name'],
                'user_id'=> $this->user['user_id'],
                'avatar'=> $this->user['avatar'],
                'time' => $this->thongbao['created_at'],
            ] ;
        }
    }
}
