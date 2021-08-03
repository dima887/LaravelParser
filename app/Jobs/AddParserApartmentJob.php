<?php

namespace App\Jobs;

use App\Models\Apartment;
use App\Models\Parser\ApartmentParser;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class AddParserApartmentJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $start;
    public $end;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($start, $end)
    {
        $this->start = $start;
        $this->end = $end;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $parserApartment = new ApartmentParser();
        $parserUrlsPaginate = $parserApartment->getPaginate($this->start, $this->end);
        $parserApartment = $parserApartment->getParserApartment($parserUrlsPaginate);
        $count = count($parserApartment['image']);
        for ($i = 0; $i < $count; $i++) {
            Apartment::create([
                'url' => $parserApartment['url'],
                'name' => $parserApartment['name'],
                'image' => $parserApartment['image'][$i],
                'price' => $parserApartment['price'][$i],
                'date' => $parserApartment['date'][$i],
                'title' => $parserApartment['title'][$i],
                'href' => $parserApartment['href'][$i],
                'address' => $parserApartment['address'][$i],
                'room' => $parserApartment['room'][$i],
                'description' => $parserApartment['description'][$i],
                'area' => $parserApartment['area'][$i],
                'metro' => $parserApartment['metro'][$i],
                'appliances' => $parserApartment['appliances'][$i],
            ]);
        }
    }
}
