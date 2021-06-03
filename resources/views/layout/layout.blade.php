<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> @yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <script src='{{ asset('js/bootstrap.js') }}'></script>
    <script src='{{ asset('js/app.js') }}'></script>

</head>

<body>
    <nav class="navbar navbar-expand navbar-light bg-light">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                @guest
                    <ul class="navbar-nav">
                        <li class="nav-item " style="padding: 0px 10px">
                            <h5><a class="nav-link active text-primary p-3" aria-current="page"
                                    href="{{ route('register') }}">Register</a></h5>
                        </li>
                        <li class="nav-item" style="padding: 0px 10px">
                            <h5><a class="nav-link active text-primary p-3" aria-current="page"
                                    href="{{ route('login') }}">Sign In</a></h5>
                        </li>
                    </ul>
                @endguest
                @auth
                    @if (Request::is('{id}/control-centre'))
                        <ul class="navbar-nav">
                            <li class="nav-item " style="padding: 0px 10px">
                                <a class="text-decoration-none" href="{{ route('home') }}">
                                    <h5 class="text-primary">
                                        << </h5>
                                </a>
                            </li>
                        </ul>
                    @endif
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <h5 class="nav-link dropdown-toggle text-primary" id="navbarDropdownMenuLink" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                {{ auth()->user()->email }}
                            </h5>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <li>
                                    <form action="{{ route('user.logout') }}" class="dropdown-item" method="post">
                                        @csrf
                                        <button class="btn btn-link text-decoration-none" type="submit">
                                            <h6>
                                                Sign Out
                                            </h6>
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    </ul>
                @endauth
            </div>
        </div>
    </nav>
    @guest
        <div class="text-center my-4">
            <h2 class="">Poll Maker</h2>
            <h6 class="text-secondary">Create your poll with ease</h6>
        </div>
    @endguest
    @yield('content')

</body>

</html>
