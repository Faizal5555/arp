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

class question_email
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
     public $question_email;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($question_email)
    {
        $this->question_email=$question_email;
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
