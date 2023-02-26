<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <style>


.gallery__item{
  
    background-image: url('https://oaidalleapiprodscus.blob.core.windows.net/private/org-1gUtPfjSwG9DQk7hyUWhTWsJ/user-3qwUEI1cS0TXw0A8JUXoBeIa/img-CtJ9IS7MT9NPLEjCxumdfS60.png?st=2023-02-26T13%3A09%3A29Z&se=2023-02-26T15%3A09%3A29Z&sp=r&sv=2021-08-06&sr=b&rscd=inline&rsct=image/png&skoid=6aaadede-4fb3-4698-a8f6-684d7786b067&sktid=a48cca56-e6da-484e-a814-9c849652bcb3&skt=2023-02-26T12%3A04%3A23Z&ske=2023-02-27T12%3A04%3A23Z&sks=b&skv=2021-08-06&sig=F2i69ACwp14/4ZONJPK3bErSSLCJSaGYLtqmvxZujD0%3D');
    display: flex;
    min-width: 25%;
    min-height: 200px;
    background-size: cover;
    background-position: center center;
    cursor: pointer;
    position: relative;
    justify-content: center;
    align-items: end;
}
.gallery_box {
    display: flex;
    /* gap: 39px; */
    flex-wrap: wrap;
    justify-content: left;
    align-items: center;
}
.gallery__item img {
    width: 100%;
}

.gallery__item:after {
    position: absolute;
    background: rgba(0,0,0,0.5);
    width: 0%;
    height: 100%;
    content: "";
    right:0%;
}


.gallery__item h2 {
    font-size: 20px;
    color: #fff;
    font-weight: 700;
    display: block;
    background: red;
    width: 100%;
    text-align: center;
    margin-bottom: 0px;
    padding: 5px;
    margin-left: -35px;
    visibility: hidden;
    opacity: -1;
    z-index: 1;
}
.gallery__item:hover h2{
    margin-left: 0px;
    visibility: visible;
    transition: all cubic-bezier(0.445, 0.05, 0.55, 0.95);
    opacity: 1;
}
.gallery__item:hover:after{
   
    transition: all .3s;
    right:0;
    width: 100%;

}

    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                        <li> <a href="{{ route('create.gallery')}}">create Gallery</a></li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
