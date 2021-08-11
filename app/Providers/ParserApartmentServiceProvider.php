<?php


namespace App\Providers;


use Illuminate\Support\ServiceProvider;

class ParserApartmentServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->bind('ParserApartment', 'App\Services\Parser\ParserApartment');
    }

}
