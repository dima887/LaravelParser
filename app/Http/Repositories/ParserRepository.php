<?php


namespace App\Http\Repositories;

use App\Models\Apartment;
use App\Models\Enable;
use Illuminate\Support\Facades\DB;

class ParserRepository
{
    /**
     * Получить объявление по id
     * @param $id
     * @return mixed
     */
    public function getApartmentById($id)
    {
        $apartment = Apartment::find($id);
        return $apartment;
    }

    /**
     * Поучить информацию о парсере
     * @return \Illuminate\Support\Collection
     */
    public function getParserInfo()
    {
        $infoParser = Apartment::query()
            ->select('url', 'name', DB::raw('COUNT(id) AS countParse' ))
            ->where('name', 'Apartment')
            ->toBase()
            ->get();
        return $infoParser;
    }

    /**
     * Узнать включен парсер или нет
     * @return int
     */
    public function getEnableParser()
    {
        $on = Enable::query()->count('id');
        return $on;
    }
}
