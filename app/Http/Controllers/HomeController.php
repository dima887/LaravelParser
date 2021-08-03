<?php

namespace App\Http\Controllers;

use App\Filters\ApartmentFilter;
use App\Http\Repositories\ParserRepository;
use App\Http\Requests\AddAdApartmentRequest;
use App\Jobs\MailNewAdApartmentJob;
use App\Models\Apartment;

class HomeController extends Controller
{
    protected $parserRepository;

    public function __construct()
    {
        $this->parserRepository = app(ParserRepository::class);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ApartmentFilter $apartmentFilter)
    {
        $parsers = Apartment::filter($apartmentFilter)->paginate(9);
        $sortAd = [
            'price' => 'Цена: по возростанию',
            'priceUp' => 'Цена: по убыванию',
            'room' => 'По кол-ву комнат: по возростанию',
            'roomUp' => 'По кол-ву комнат: по убыванию',
        ];
        return view('index', compact('parsers', 'sortAd'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ad.createAd');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddAdApartmentRequest $request, $id)
    {
        dispatch(new MailNewAdApartmentJob($id));

        $data = $request->all();
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store("app/apartment");
        }
        Apartment::create($data);

        return redirect()->route('home')->with('success', 'Объявление добавлено');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $apartment = $this->parserRepository->getApartmentById($id);

        return view('ad.showAd', compact('apartment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $apartment = $this->parserRepository->getApartmentById($id);
        return view('ad.editAd', compact('id', 'apartment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AddAdApartmentRequest $request, $id)
    {

        $apartment = $this->parserRepository->getApartmentById($id);
        $apartment->title = $request->title;
        $apartment->description = $request->description;
        $apartment->address = $request->address;
        $apartment->price = $request->price;
        $apartment->area = $request->area;
        $apartment->metro = $request->metro;
        $apartment->appliances = $request->appliances;
        $apartment->image = $request->image;
        if ($request->hasFile('image')) {
            $apartment['image'] = $request->file('image')->store("app/apartment");
        }
        $apartment->save();
        return redirect()->route('home')->with('success', 'Объявление отредактировано');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = Apartment::find($id);
        if (file_exists($delete->image)) {
            unlink(public_path($delete->image));
        }
        Apartment::destroy($id);
        return redirect()->route('home')->with('success', 'Объявление удалено');
    }
}
