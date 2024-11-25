<?php

namespace App\Listeners;

use App\Events\BulkRegistrationMail;
use Illuminate\Support\Facades\Mail;

class SendBulkRegistrationMail
{
    /**
     * Handle the event.
     *
     * @param BulkRegistrationMail $event
     * @return void
     */
    public function handle(BulkRegistrationMail $event)
    {   
        dd($event);
        foreach ($event->users as $user) {
            Mail::send('mails.bulk_registration', [
                'email' => $user['encryptedEmail'],
                'password' => $user['password'],
            ], function ($message) use ($user) {
                $message->to($user['email'])
                    ->subject('User Activate Status');
            });
        }
    }
}

