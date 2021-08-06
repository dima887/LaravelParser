<?php

namespace App\Providers;

use App\Events\AdCreated;
use App\Listeners\NewAdEmailNotification;
use App\Models\Apartment;
use App\Observers\ApartmentObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

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
        AdCreated::class => [
            NewAdEmailNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        Apartment::observe(new ApartmentObserver());
    }
}
