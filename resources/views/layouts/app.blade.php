<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>SICC</title>

    <!-- Scripts -->
    <script src="js/app.js" defer></script>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link rel="stylesheet" href="css\proyect.css">
    <link href="css\app.css" rel="stylesheet">
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a href="{{route('home')}}" class="navbar-brand text-muted">
                <h3>SICC</h3>
            </a>
            <button class="navbar-toggler collapsed" type="button" data-toggle="collapse"
                data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                @if(!Auth::guest()&&(Auth::user()->hasRole('admin')||Auth::user()->hasRole('revisor')))
                <ul class="navbar-nav mr-auto">

                    <li class="nav-item">
                        <a href="{{route('Agreement.index')}}" class="nav-link">Documentos</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('FinalRegister.index')}}" class="nav-link">Registros</a>
                    </li>
                    @if(count (Auth::user()->getAgreements))
                    <li class="nav-item">
                        <a href="{{route('Revision')}}" class="nav-link">Asignados</a>
                    </li>
                    @endif

                    @if(Auth::user()->hasRole('admin'))

                    <li class="nav-item">
                        <a href="{{route('users.index')}}" class="nav-link">Usuarios</a>
                    </li>

                    @endif
                </ul>
                @endif
                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                    <li class="nav-item">
                        <a href="{{route ('public')}}" class="nav-link">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Iniciar sesión') }}</a>
                    </li>

                    @if (Route::has('register'))
                    <!-- <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Registrarse') }}</a>
                        </li> -->
                    @endif
                    @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <!--LOGOUT-->

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Cerrar Sesión') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                            <a class="dropdown-item" href="{{ route('users.reset') }}">
                                {{ __('Editar usuario') }}
                            </a>
                        </div>
                    </li>
                    @endguest
                </ul>
            </div>

        </nav>
    </div>
    <main class="pb-4 mb-5">
        @yield('content')
    </main>
    @yield('scripts')
    <script src="vendors\ckeditor\ckeditor.js"></script>

</body>

</html>