@extends('layouts.layout')

@section('content')

    <div class="container">
        @include('layouts.alerts')
            @if($on == 0)
                <div class="card mt-3">
                    <div class="card-header">
                        <p class="btn btn-primary">Информация о парсере</p>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{route('start.parser', ['id' => auth()->user()->id])}}">
                            @csrf
                            <div class="form-group mt-3">
                                <label for="start">Номер стартовой страницы(необязятельно)</label>
                                <input type="text" name="start" class="form-control" id="start" aria-describedby="emailHelp" placeholder="Старт">
                            </div>
                            <div class="form-group mt-3">
                                <label for="end">Номер последней страницы(необязятельно)</label>
                                <input type="text" name="end" class="form-control" id="end" aria-describedby="emailHelp" placeholder="Конец">
                            </div>
                            <input hidden name="enable" value="1">
                            <button type="submit" class="btn btn-primary mt-3">Запустить парсер</button>
                        </form>
                    </div>
                </div>
            @endif

            @if($on != 0)
                <div class="card mt-3">
                    <div class="card-header">
                        <p class="btn btn-primary">Информация о парсере</p>
                    </div>
                    <div class="card-body">
                        @foreach($infoParser as $val)
                        <h3 class="card-title">{{$val->name}} - <small>имя парсера</small></h3>
                        <hr>
                        <p class="card-text">Url адрес - {{$val->url}}</p>
                        <hr>
                        <p class="card-text">Количество записей - {{$val->countParse}}</p>
                        @endforeach
                            <form method="post" action="{{route('start.parser')}}">
                            @csrf
                            <input hidden name="enable" value="0">
                            <button type="submit" class="btn btn-danger mt-3">Остановить парсер</button>
                        </form>
                    </div>
                </div>
            @endif
    </div>



@endsection
