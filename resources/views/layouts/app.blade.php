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
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css">
    <style>


.gallery__item{
  
    background-image: url('https://oaidalleapiprodscus.blob.core.windows.net/private/org-1gUtPfjSwG9DQk7hyUWhTWsJ/user-3qwUEI1cS0TXw0A8JUXoBeIa/img-NCI56FkXahD3O8gYa0lQveZy.png?st=2023-02-28T20%3A42%3A41Z&se=2023-02-28T22%3A42%3A41Z&sp=r&sv=2021-08-06&sr=b&rscd=inline&rsct=image/png&skoid=6aaadede-4fb3-4698-a8f6-684d7786b067&sktid=a48cca56-e6da-484e-a814-9c849652bcb3&skt=2023-02-28T21%3A42%3A10Z&ske=2023-03-01T21%3A42%3A10Z&sks=b&skv=2021-08-06&sig=PVwTUNMK3nubO36WuJFndvUk7DCZWAAW0QtHtb8UCY8%3D');
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
                        <li class="nav-item"> <a    href="{{ route('create.album')}}">Create Album</a></li>
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
    <script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
        <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
        <script src="
https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js
"></script>
<script>
  
$('.show_confirm').click(function(event){
    let form = $(this).closest('form');

    event.preventDefault();
    Swal.fire({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!'
}).then((result) => {
  if (result.isConfirmed) {
    form.submit();
    Swal.fire(
      'Deleted!',
      'Your file has been deleted.',
      'success'
    )
  }
})
})

</script>
        {!! Toastr::message() !!}
            @if ($errors->any())
            <script>
                @foreach ($errors->all() as $error)
                    toastr.error('{{ $error }}')
                @endforeach
            </script>
        @endif
</body>
</html>
