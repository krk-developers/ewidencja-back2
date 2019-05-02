@section('nav')
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="{{ route('home') }}" title="Strona główna">
                <!-- <img src="{{ asset('img/logo.png') }}" width="30" height="30" class="d-inline-block align-top" alt="Ewipanel"> -->
                <i class="fab fa-elementor"></i>
                Ewipanel
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active"><a class="nav-link" href="{{ route('home') }}" title="Strona główna">Strona główna <span class="sr-only">(current)</span></a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Użytkownicy
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
@if ($user->type->name == 'superadmin')
                            <a class="dropdown-item" href="{{ route('superadmins.index') }}" title="Super Administratorzy">Super Administratorzy</a>
@endif
@if ($user->type->name == 'superadmin' || $user->type->name == 'admin')
                            <a class="dropdown-item" href="{{ route('admins.index') }}" title="Administratorzy">Administratorzy</a>
@endif
@if ($user->type->name == 'superadmin' || $user->type->name == 'admin' || $user->type->name == 'employer')
                            <a class="dropdown-item" href="{{ route('employers.index') }}" title="Pracodawcy">Pracodawcy</a>
@endif
@if ($user->type->name == 'superadmin' || $user->type->name == 'admin' || $user->type->name == 'employer' || $user->type->name == 'worker')
                            <a class="dropdown-item" href="{{ route('workers.index') }}" title="Pracownicy">Pracownicy</a>
@endif
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Kalendarz
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('legends.index') }}" title="Typy wydarzeń">Legenda</a>
                            <a class="dropdown-item" href="{{ route('holidays.index') }}" title="Dni ustawowo wolne od pracy">Wolne</a>
                            <a class="dropdown-item" href="{{ route('events.index') }}" title="Wszystkie wydarzenia">Wydarzenia</a>
                        </div>
                    </li>
                    {{--
                    <li class="nav-item"><a class="nav-link" href="#" title="">Super Administratorzy</a></li>
                    <li class="nav-item"><a class="nav-link" href="#" title="">Administratorzy</a></li>
                    <li class="nav-item"><a class="nav-link" href="#" title="">Wydarzenia</a></li>
                    --}}
                </ul>
                <form class="form-inline my-2 my-lg-0" action="{{ route('logout') }}" method="POST">
                    @csrf
                    
                    <button class="btn btn-outline-secondary btn-sm" type="submit"><i class="fas fa-sign-out-alt"></i> Wyloguj</button>
                </form>
            </div>
        </nav>
@show
