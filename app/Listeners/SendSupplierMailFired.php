<?php

namespace App\Listeners;

use App\Events\SendSupplierMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Config;

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
        // $supplier_details = $event->data;
        // // dd($supplier_details);
        // if($supplier_details[2] !=""){
        // Mail::send('mails.supplier_mail', ['data' => $supplier_details],
        //     function ($mail) use ($supplier_details) {
        //         $mail->from('requestforquote@asiaresearchpartners.com');
        //         $mail->to($supplier_details[0]);
        //         $mail->cc('businessresearch@asiaresearchpartners.com');
        //         $mail->attach(public_path($supplier_details[2]));
        //         $mail->subject('Supplier Notification');
        //     });
        // }else{
        //        Mail::send('mails.supplier_mail', ['data' => $supplier_details],
        //     function ($mail) use ($supplier_details) {
        //         $mail->from('requestforquote@asiaresearchpartners.com');
        //         $mail->to($supplier_details[0]);
        //         $mail->cc('businessresearch@asiaresearchpartners.com');
        //         $mail->subject('Supplier Notification');
        //     });
        // }
        $supplier_details = $event->data; // [0] = toEmail, [1] = content, [2] = optional file

            // 🔐 Override SMTP settings for this specific email
            Config::set('mail.mailers.smtp.transport', 'smtp');
            Config::set('mail.mailers.smtp.host', 'smtp.gmail.com');
            Config::set('mail.mailers.smtp.port', 587);
            Config::set('mail.mailers.smtp.username', 'quotesarp@asiaresearchpartners.com');
            Config::set('mail.mailers.smtp.password', 'swlgxjrkggbcwpck'); // xlxjdqotgsbwyklj Your app password here
            Config::set('mail.mailers.smtp.encryption', 'tls');

            // Also override the "from" address
            Config::set('mail.from.address', 'quotesarp@asiaresearchpartners.com');
            Config::set('mail.from.name', 'Request For Quotation - Asia Research Partners');

            // 📨 Send email with or without attachment
            Mail::send('mails.supplier_mail', ['data' => $supplier_details], function ($mail) use ($supplier_details) {
                $mail->to($supplier_details[0]);
                // $mail->cc('businessresearch@asiaresearchpartners.com');
                $mail->subject('Cost Request For Potential Project');

                if (!empty($supplier_details[2]) && file_exists(public_path($supplier_details[2]))) {
                    $mail->attach(public_path($supplier_details[2]));
                }
            });

    }
}
