@extends('layouts.layout')

@section('content')

    <div class="container mt-3">
        <div class="text-center">
            <h1 class="text-info">Все объявления</h1>
        </div>
        @auth()
            <div class="text-center">
                <a href="{{route('ad.create')}}" class="btn btn-primary">Создать объявление</a>
            </div>
        @endauth
        <div class="">
            <div class="row">
            @include('layouts.alerts')
            <form class="col-2" action="{{route('home')}}" method="get">
                <div class="mb-3">
                    <div class="form-label">Сортировка</div>
                    <select name="apartment_filter" class="form-select form-select-sm" aria-label=".form-select-sm example">
                        <option></option>
                        @foreach($sortAd as $key => $col)
                            <option value="{{$key}}" @if(isset($_GET['apartment_filter'])) @endif>{{$col}}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Отсортировать</button>
            </form>
            </div>
        </div>
        <div class="row">
        @foreach($parsers as $parser)
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card" style="width: 18rem;">
                    <img src="{{$parser->image}}" class="card-img-top" alt="Нет изображения">
                    <div class="card-body">
                        @if(!is_null($parser->price))
                            <span class="card-text">{{$parser->price}} BYN | </span>
                        @else
                            <span class="card-text">Договорная цена | </span>
                        @endif
                        @if(!is_null($parser->room))
                            <span class="card-text">{{$parser->room}}-комн</span>
                        @else
                            <span class="card-text">0-комн</span>
                        @endif
                        <span class="card-text">ID:{{$parser->id}}</span>
                        <h5 class="card-title">{!! $parser->title !!}</h5>
                        <p class="card-text">{{$parser->address}}</p>
                        <p class="card-text">{{$parser->description}}</p>
                        <p class="card-text"><small class="text-muted">{{$parser->date}}</small></p>
                        <a href="{{route('ad.show', ['id' => $parser->id])}}" class="btn btn-primary">Просмотр</a>
                        @auth
                        <a href="{{route('ad.edit', ['id' => $parser->id])}}">
                            <button type="button" class="btn btn-block btn-info"
                                    wfd-id="544">Редактировать</button></a>
                        @endauth
                        @auth
                        <form class="mt-1" action="{{route('ad.delete', ['id' => $parser->id])}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-block btn-danger"
                                    wfd-id="44" value="submit">Удалить</button>
                        </form>
                        @endauth

                    </div>
                </div>
            </div>

        @endforeach
        </div>
        <div class="text-center">
            <div>
                {{ $parsers->onEachSide(5)->links() }}
            </div>
        </div>
    </div>

@endsection
