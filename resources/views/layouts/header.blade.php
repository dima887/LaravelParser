<nav class="navbar navbar-expand-lg navbar-light bg-info">
  <div class="container">
    <a class="navbar-brand" href="{{route('home')}}">Просмотр объявлений</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
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
