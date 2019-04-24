<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                data-target="#app-navbar-collapse" aria-expanded="false">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            <a href="{{ url('/') }}">
                <img src="{{ asset('./img/logo.png') }}" alt="PixelPay" class="logo">
            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                &nbsp;
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @guest
                <li><a href="{{ route('login') }}">Iniciar Sesión</a></li>
                {{-- <li><a href="{{ route('register') }}">Registrarse</a></li> --}}
                @else
                <li>
                    <a href="{{ route('new-customer') }}">Nuevo Contrato</a>
                </li>
                <li>
                    <a href="{{route('attach-contract')}}">Subir Contrato</a>
                </li>
                {{-- <li>
                    <a href="{{ route('index') }}">Todos los Contratos</a>
                </li> --}}
                <li>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            <i class="fas fa-power-off" style="font-size:15px;"></i>
                            Cerrar Sesión
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                        style="display: none;">
                            {{ csrf_field() }}
                    </form>
                </li>
                 @endguest
            </ul>
        </div>
    </div>
</nav>