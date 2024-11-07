<?php

namespace App\Listeners;

use App\Events\SendInvoiceMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendInvoiceMailFired
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
     * @param  \App\Events\SendInvoiceMail  $event
     * @return void
     */
    public function handle(SendInvoiceMail $event)
    {
        $in=$event->invoice;
        Mail::send('mails.invoicemail', ['invoices' =>  $in],
        function ($mail) use ( $in) {
            $mail->from('registrations@healthcarepanelsindia.com');
            $mail->to('accountsreceivable@asiaresearchpartners.com');
            $mail->cc($in[0]);
            $mail->subject('Accounts Notification');
            $mail->attach(public_path($in[5]));
        });
    }
}
