<?php

namespace App\Listeners;

use App\Events\SendpopinviteMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendpopinviteMailFired
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
     * @param  \App\Events\SendpopinviteMail  $event
     * @return void
     */
    public function handle(SendpopinviteMail $event)
    {
        $user=$event->url;
        // dd($user);
        Mail::send('mails.genpop_send_link', ['url' =>  $user],
        function ($mail) use ( $user) {
            $mail->from('registration@universalresearchpanels.com');
            $mail->to( $user[0]);
            $mail->subject('General User Notification');
        });
    }
}
