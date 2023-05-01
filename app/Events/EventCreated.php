<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class EventCreated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $notification;
    public $user;

    public function __construct($user, $notification)
    {
        $this->notification = $notification;
        $this->user = $user;
    }

    public function broadcastOn()
    {
        return new Channel('testchannel');
    }

    // public function broadcastAs()
    // {
    //     return 'my-event';
    // }
}
