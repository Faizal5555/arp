<?php

namespace App\Listeners;

use App\Events\question_email as EventsQuestion_email;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class question_email
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
     * @param  EventsQuestion_email  $event
     * @return void
     */
    public function handle($event)
    {   
        // dd($event);
        $user=$event->question_email;
        
        // dd($user);
        Mail::send('mails.pop_success',['data' => $user],
        function ($mail) use ($user) {
            $mail->from('registration@universalresearchpanels.com');
            $mail->cc('registration@universalresearchpanels.com');
            $mail->to($user[0]);
            $mail->subject('Invitation to Join Our Global Healthcare Research Panel');
        });
    }
}
