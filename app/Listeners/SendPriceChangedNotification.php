<?php

namespace App\Listeners;

use App\Events\Pricechanged;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class SendPriceChangedNotification
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
     * @param  \App\Events\Pricechanged  $event
     * @return void
     */
    public function handle(Pricechanged $event)
    {
        //
        $user = new User;

        $users = $user->where('is_superadmin', null)->get();
        $finalprice=User::where('is_superadmin',1)->get();
        $priceis=$finalprice[0]['price'];
        for ($i = 0; $i < sizeof($users); $i++) {
            $tomail = $users[$i]->email;

            $data1 = array('price' => $priceis, 'email' => $tomail);

            Mail::send('mail.price', ["data1" => $data1], function ($m) use ($data1) {
                $m->from('hello@app.com', 'Your Application');

                $m->to($data1['email'])->subject('Your Reminder!');
            });
        }
    }
}
