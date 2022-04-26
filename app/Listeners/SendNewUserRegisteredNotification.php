<?php

namespace App\Listeners;

use App\Events\NewUserRegistered;
use App\Models\User;
use Nexmo\Laravel\Facade\Nexmo;

class SendNewUserRegisteredNotification
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
     * @param  \App\Events\NewUserRegistered  $event
     * @return void
     */
    public function handle(NewUserRegistered $event)
    {
        //send sms to new user of admin area
        $admin = $event->user->where('area', $event->user->area)->where('is_admin', 1)->get();
        $number = $admin[0]['phone_number'];

        Nexmo::message()->send([
            'to' => '91' . $number,
            'from' => '919638824606',
            'text' => 'New User joined in your area',
        ]);

    }
}
