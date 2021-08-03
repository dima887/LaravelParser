@extends('layouts.layout')

@section('content')
    <div class="container mt-3">
        <div class="text-center">
            <h3>{!! $apartment->title !!}</h3>
            <img src="{{$apartment->image}}" class="rounded mt-3" alt="Нет изображения">
            <div class="card-body">
                @if(!is_null($apartment->price))
                    <span class="card-text">{{$apartment->price}} BYN | </span>
                @else
                    <span class="card-text">Договорная цена | </span>
                @endif
                @if(!is_null($apartment->room))
                    <span class="card-text">{{$apartment->room}}-комн | </span>
                @else
                    <span class="card-text">Количество комнат: не указано | </span>
                @endif
                <span class="card-text">{{$apartment->date}} | </span>
                <span class="card-text">ID: {{$apartment->id}}</span>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col"></div>
            <div class="col-8">
                <h3>Описание</h3>
                <p>{{$apartment->description}}</p>
            </div>
            <div class="col"></div>
        </div>
        <hr>
        <div class="row">
            <div class="col"></div>
            <div class="col-8">
                <h4>Дополнительно</h4>
                <table class="table table-striped mt-3">
                    <tbody>
                    <tr>
                        <th scope="row">Адрес</th>
                        <td class="col-9">{{$apartment->address}}</td>
                    </tr>
                    <tr>
                        <th scope="row">Метро</th>
                        <td class="col-9">{{$apartment->metro}}</td>
                    </tr>
                    <tr>
                        <th scope="row">Бытовая техника</th>
                        <td class="col-9">{{$apartment->appliances}}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="col"></div>
        </div>
    </div>

@endsection
