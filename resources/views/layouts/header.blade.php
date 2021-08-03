<nav class="navbar navbar-expand-lg navbar-light bg-info">
    <div class="container-fluid">
        <div class="collapse navbar-collapse justify-content-center" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-link" href="{{route('home')}}">Просмотр объявлений</a>
                @auth()
                    <a class="nav-link" href="{{route('info.parser')}}">Парсер</a>
                @endauth
                @guest()
                    <a class="nav-link" href="{{route('login')}}">Войти</a>
                    <a class="nav-link" href="{{route('register')}}">Регистрация</a>
                @endguest
                @auth()
                    <a class="nav-link" href="{{route('logout')}}">Выйти</a>
                @endauth
            </div>
        </div>
    </div>
</nav>
