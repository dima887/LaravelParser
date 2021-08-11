<?php

namespace App\Http\Controllers\ParserApartment;

use App\Http\Controllers\Controller;
use App\Http\Repositories\ParserRepository;
use App\Http\Requests\ParserApartment\ParserPaginateRequest;
use App\Jobs\AddParserApartmentJob;
use App\Models\Apartment;
use App\Models\Enable;

class ParserApartmentController extends Controller
{
    protected $parserRepository;

    public function __construct()
    {
        $this->parserRepository = app(ParserRepository::class);
    }

    /**
     * ParserAd information
     */
    public function infoParser()
    {
        $infoParser = $this->parserRepository->getParserInfo();
        $on = $this->parserRepository->getEnableParser();
        return view('ParserApartment.infoParser', compact('on', 'infoParser'));
    }

    /**
     * Enable parser
     */
    public function startParser(ParserPaginateRequest $request)
    {
        if ($request->enable == 1) {
            dispatch(new AddParserApartmentJob($request->start, $request->end));
            Enable::create(['enable' => $request->enable]);
            return redirect()->route('info.parser')->with('success', 'Парсер добавлен в очередь, как только все данные спарсятся, данные отобразятся');
        }

        Enable::truncate();
        Apartment::where('name', 'Apartment')->delete();
        return redirect()->route('info.parser')->with('success', 'Парсер выключен');
    }
}
