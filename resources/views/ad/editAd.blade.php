@extends('layouts.layout')

@section('content')
    <div class="container">
        <h2 class="text-center text-info">Редактирование объявления ID:{{$apartment->id}}</h2>

        @include('layouts.alerts')

        <div class="row justify-content-center align-items-center h-100">
            <div class="col col-sm col-md col-lg col-xl-8">
                <form method="post" action="{{route('ad.update', ['id' => $id])}}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="title">Заголовок</label>
                        <textarea name="title" class="form-control" id="title"
                                  rows="1">@if(old('title')){{old('title')}}@else{{$apartment->title}}@endif</textarea>
                    </div>
                    <div class="form-group">
                        <label for="description">Описание</label>
                        <textarea name="description" class="form-control" id="description"
                                  rows="3">@if(old('description')){{old('description')}}@else{{$apartment->description}}@endif</textarea>
                    </div>
                    <div class="form-group">
                        <label for="address">Адрес</label>
                        <textarea name="address" class="form-control" id="address"
                                  rows="1">@if(old('address')){{old('address')}}@else{{$apartment->address}}@endif</textarea>
                    </div>
                    <div class="form-group">
                        <label for="price">Цена BYN</label>
                        <textarea name="price" class="form-control" id="price"
                                  rows="1">@if(old('price')){{old('price')}}@else{{$apartment->price}}@endif</textarea>
                    </div>
                    <div class="form-group">
                        <label for="area">Район</label>
                        <textarea name="area" class="form-control" id="area"
                                  rows="1">@if(old('area')){{old('area')}}@else{{$apartment->area}}@endif</textarea>
                    </div>
                    <div class="form-group">
                        <label for="metro">Метро</label>
                        <textarea name="metro" class="form-control" id="metro"
                                  rows="1">@if(old('metro')){{old('metro')}}@else{{$apartment->metro}}@endif</textarea>
                    </div>
                    <div class="form-group">
                        <label for="appliances">Бытовая техника</label>
                        <textarea name="appliances" class="form-control" id="appliances"
                                  rows="1">@if(old('appliances')){{old('appliances')}}@else{{$apartment->appliances}}@endif</textarea>
                    </div>
                    <div class="form-group">
                        <label for="image">Изображение</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" name="image" id="image"
                                       class="custom-file-input">
                                <label class="custom-file-label" for="image">Выбрать файл</label>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Изменить</button>
                </form>
            </div>
        </div>
    </div>


@endsection
