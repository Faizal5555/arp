<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Clientrequest;

class SendClientInvoiceMail
{
    use SerializesModels;

    public $clientRequest;
    public $email;

    public function __construct(Clientrequest $clientRequest, $email)
    {
        $this->clientRequest = $clientRequest;
        $this->email = $email;
    }
}


