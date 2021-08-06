<?php

namespace App\Jobs;

use App\Mail\AddAdNewApartmentMail;
use App\Mail\UpdateParserApartmentMail;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class MailNewAdApartmentJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $id;
    protected $apartment;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($id, $apartment)
    {
        $this->id = $id;
        $this->apartment = $apartment;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $email = User::find($this->id);
        Mail::to($email->email)->send(new AddAdNewApartmentMail($this->apartment));
    }
}
