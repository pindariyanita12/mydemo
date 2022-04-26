<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * @var string
     */
    public $details = '';
    public $timeout = 7200;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        //
        $this->details = $details;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $user = new User;
        $data = $user->where('is_admin', null)->where('is_superadmin', null)->with('liters')->get();
        //sending mail to all users
        for ($i = 0; $i < sizeof($data); $i++) {
            $sum = 0;
            $toname = $data[$i]->name;
            $tomail = $data[$i]->email;
            for ($j = 0; $j < sizeof($data[$i]->liters); $j++) {

                $sum = $sum + ($data[$i]->liters[$j]->rupees);

            }
            $data1 = array('total' => $sum, 'name' => $toname, 'email' => $tomail);

            Mail::send('mail.Test_mail', ["data1" => $data1], function ($m) use ($data1) {
                $m->from('hello@app.com', 'Your Application');

                $m->to($data1['email'])->subject('Your Reminder!');
            });

        }

    }
}
