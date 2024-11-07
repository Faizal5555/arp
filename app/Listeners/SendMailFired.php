<?php

namespace App\Listeners;
use App\Events\SendMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendMailFired
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
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $admin_user = $event->data;
        // dd($admin_user);
        Mail::send('mails.confirmation', ['data' => $admin_user],
            function ($mail) use ($admin_user) {
                $mail->from('sales@marketingagencymd.com');
                $mail->to($admin_user[0]);
                $mail->subject('User Activate Status');
            });
    }
}
