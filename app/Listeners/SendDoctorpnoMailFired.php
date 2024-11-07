<?php

namespace App\Listeners;
use App\Events\SendDoctorpnoMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
class SendDoctorpnoMailFired
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
     * @param  SendDoctorpnoMail  $event
     * @return void
     */
    public function handle(SendDoctorpnoMail $event)
    {
        $user=$event->value;
        Mail::send('mails.doctorpno', ['value' =>  $user],
        function ($mail) use ( $user) {
            $mail->from('sales@marketingagencymd.com');
            $mail->to( $user[0]);
            $mail->subject('Doctor Notification');
        });
    }
}
