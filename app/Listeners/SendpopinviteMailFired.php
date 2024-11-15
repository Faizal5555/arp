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
        $data = $event->data;
        $emails = $data['emails'];
        $link = $data['link'];
        $emailContent = $data['emailContent'];
        $attachment = $data['attachment'];

        foreach ($emails as $email) {
            Mail::send('mails.genpop_send_link', ['link' => $link, 'emailContent' => $emailContent], function ($mail) use ($email, $attachment) {
                $mail->from('registration@universalresearchpanels.com');
                $mail->to(trim($email));
                $mail->subject('General User Notification');

                if ($attachment) {
                    $mail->attach($attachment->getRealPath(), [
                        'as' => $attachment->getClientOriginalName(),
                        'mime' => $attachment->getMimeType()
                    ]);
                }
            });
        }
    }
}
