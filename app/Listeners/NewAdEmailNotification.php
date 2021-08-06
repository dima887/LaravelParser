<?php

namespace App\Listeners;

use App\Events\AdCreated;
use App\Mail\AddAdNewApartmentMail;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class NewAdEmailNotification implements ShouldQueue
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
     * @param  AdCreated  $event
     * @return void
     */
    public function handle(AdCreated $apartment)
    {
        $email = User::find($apartment->id);
        Mail::to($email->email)->send(new AddAdNewApartmentMail());
    }
}
