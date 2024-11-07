<?php

namespace App\Events;
use App\Events\Event;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SendUserMail
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    use SerializesModels;
    public $data;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        
        $this->data=$data;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
