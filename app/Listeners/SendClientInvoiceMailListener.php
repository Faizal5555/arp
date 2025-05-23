<?php

namespace App\Listeners;

use App\Events\SendClientInvoiceMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Config;

class SendClientInvoiceMailListener
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
     * @param  \App\Events\SendClientInvoiceMail  $event
     * @return void
     */
    public function handle(SendClientInvoiceMail $event)
    {
        $client = $event->clientRequest;
        $email = $event->email;

        $data = [
            'client_id'     => $client->client_id,
            'currency'      => $client->currency,
            'amount'        => $client->amount,
            'invoice_type'  => $client->invoice_type,
        ];

        Config::set('mail.mailers.smtp.transport', 'smtp');
        Config::set('mail.mailers.smtp.host', 'smtp.gmail.com');
        Config::set('mail.mailers.smtp.port', 587);
        Config::set('mail.mailers.smtp.username', 'accounts@asiaresearchpartners.com');
        Config::set('mail.mailers.smtp.password', 'dilkrgsutejkdcej'); // App password
        Config::set('mail.mailers.smtp.encryption', 'tls');

        // Also override the "from" address
        Config::set('mail.from.address', 'accounts@asiaresearchpartners.com');
        Config::set('mail.from.name', 'Client Invoice - Asia Research Partners');

        // 📨 Send email
        Mail::send('mails.client_invoice', ['data' => $data], function ($message) use ($email,$client) {
            $message->to($email);
            $message->subject('Invoice Notification');

            if (!empty($client->upload_invoice) && file_exists(public_path($client->upload_invoice))) {
                $message->attach(public_path($client->upload_invoice));
            }
        });
    }
}
