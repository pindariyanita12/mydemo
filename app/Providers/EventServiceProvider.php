<?php

namespace App\Providers;

use App\Models\User;
use App\Observers\UserObserver;
use App\Events\NewUserRegistered;
use App\Events\Pricechanged;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use App\Listeners\SendNewUserRegisteredNotification;
use App\Listeners\SendPriceChangedNotification;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        NewUserRegistered::class => [
            SendNewUserRegisteredNotification::class,
        ],
        Pricechanged::class=>[
            SendPriceChangedNotification::class,
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        User::observe(UserObserver::class);
    }
}
