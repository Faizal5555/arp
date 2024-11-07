<?php

namespace App\Listeners;
use App\Events\SendMail;
use App\Events\SendUserMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendUserMailFired
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  SendUserMail  $event
     * @return void
     */
    public function handle(SendUserMail $event)
    {
        $user=$event->data;
        mail::send('mails.user',['data'=>$user],
        function ($mail) use ($user) {
            $mail->from('registrations@healthcarepanelsindia.com');
            $mail->to( $user[0]);
            $mail->subject('Arp Notification');
        });
    }
}
