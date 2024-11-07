<?php

namespace App\Listeners;
use App\Events\SendDoctorMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
class SendDoctorMailFired
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
     * @param  SendDoctorMail  $event
     * @return void
     */
    public function handle(SendDoctorMail $event)
    {
        $user=$event->doctor;
        // dd($user);
        if($user[2] !=""){
        Mail::send('mails.doctor', ['doctor' =>  $user],
        function ($mail) use ( $user) {
            $mail->from('registrations@healthcarepanelsindia.com');
            $mail->to($user[0]);
            $mail->cc('registrations@healthcarepanelsindia.com');
            $mail->attach(public_path($user[2]));
            $mail->subject('Doctor Notification');
        });
        }else{
             Mail::send('mails.doctor', ['doctor' =>  $user],
        function ($mail) use ( $user) {
            $mail->from('registrations@healthcarepanelsindia.com');
            $mail->to($user[0]);
            $mail->cc('registrations@healthcarepanelsindia.com');
            $mail->subject('Doctor Notification');
        });
            
        }
    }
}
