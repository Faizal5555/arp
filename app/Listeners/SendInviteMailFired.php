<?php

namespace App\Listeners;
use App\Events\SendInviteMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
class SendInviteMailFired
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
     * @param  SendInviteMail  $event
     * @return void
     */
    public function handle(SendInviteMail $event)
    {
        $user=$event->url;
        Mail::send('mails.invite', ['url' =>  $user],
        function ($mail) use ( $user) {
            $mail->from('registrations@healthcarepanelsindia.com');
            $mail->to( $user[0]);
            $mail->cc('registrations@healthcarepanelsindia.com');
            $mail->subject('Invitation to Join Our Global Healthcare Research Panel');
        });

    }
}
