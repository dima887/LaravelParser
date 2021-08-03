@extends('layouts.layout')

@section('content')

    <div class="container">
        @include('layouts.alerts')
        <h2 class="text-center text-warning">Регистрация</h2>
        <div class="d-flex justify-content-center align-items-center container ">
            <div class="row ">
                <form method="post" action="{{route('store')}}">
                    @csrf
                    <div class="form-group mt-3">
                        <label for="name">Имя</label>
                        <input type="text" name="name" class="form-control" id="name" aria-describedby="emailHelp" placeholder="Имя">
                    </div>
                    <div class="form-group mt-3">
                        <label for="name">Email</label>
                        <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Email">
                    </div>
                    <div class="form-group mt-3">
                        <label for="password">Пароль</label>
                        <input type="password" name="password" class="form-control" id="password" placeholder="Пароль">
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Зарегистрироваться</button>
                </form>
            </div>
        </div>
    </div>

@endsection
