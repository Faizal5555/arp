<?php

namespace App\Events;
use App\Listeners\SendDoctorpnonoMailFired;
use App\Events\Event;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SendDoctorpnoMail
{
    use  SerializesModels;
    public $value;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($value)
    {
        //  dd($value);
        $this->value=$value;
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
