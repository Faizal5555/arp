<?php

namespace App\Listeners;

use App\Events\SendSupplierMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendSupplierMailFired
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
     * @param  SendSupplierMail  $event
     * @return void
     */
    public function handle(SendSupplierMail $event)
    {
        //
        $supplier_details = $event->data;
        // dd($supplier_details);
        if($supplier_details[2] !=""){
        Mail::send('mails.supplier_mail', ['data' => $supplier_details],
            function ($mail) use ($supplier_details) {
                $mail->from('requestforquote@asiaresearchpartners.com');
                $mail->to($supplier_details[0]);
                $mail->cc('businessresearch@asiaresearchpartners.com');
                $mail->attach(public_path($supplier_details[2]));
                $mail->subject('Supplier Notification');
            });
        }else{
               Mail::send('mails.supplier_mail', ['data' => $supplier_details],
            function ($mail) use ($supplier_details) {
                $mail->from('requestforquote@asiaresearchpartners.com');
                $mail->to($supplier_details[0]);
                $mail->cc('businessresearch@asiaresearchpartners.com');
                $mail->subject('Supplier Notification');
            });
        }
    }
}
