<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        'App\Events\SendMail' => [
            'App\Listeners\SendMailFired',
        ],
        'App\Events\SendSupplierMail' => [
            'App\Listeners\SendSupplierMailFired',
        ],
        'App\Events\SendDoctorMail' => [
            'App\Listeners\SendDoctorMailFired',
        ],
        'App\Events\SendDoctorpnoMail' => [
            'App\Listeners\SendDoctorpnoMailFired',
        ],
        'App\Events\SendUserMail' => [
            'App\Listeners\SendUserMailFired',
        ],
        'App\Events\SendInviteMail' => [
            'App\Listeners\SendInviteMailFired',
        ],
        'App\Events\SendInvoiceMail' => [
            'App\Listeners\SendInvoiceMailFired',
        ],
        'App\Events\SendpopinviteMail' => [
            'App\Listeners\SendpopinviteMailFired',
        ],
        'App\Events\question_email' => [
            'App\Listeners\question_email',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
