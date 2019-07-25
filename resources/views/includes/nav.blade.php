@section('nav')
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="{{ route('home') }}" title="Panel administracyjny ewidencji">
                ewipAnel
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item @if($path == 'home')active @endif"><a class="nav-link" href="{{ route('home') }}" title="Strona główna">Strona główna @if($path == 'home')<span class="sr-only">(current)</span>@endif</a></li>
                    <li class="nav-item dropdown @if($path == 'superadministratorzy' || $path == 'administratorzy' || $path == 'pracodawcy' || $path == 'pracownicy')active @endif">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Użytkownicy
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
@if ($user->type->name == 'superadmin')
                            <a class="dropdown-item @if($path == 'superadministratorzy')active @endif" href="{{ route('superadmins.index') }}" title="Super Administratorzy">Super Administratorzy @if($path == 'superadministratorzy')<span class="sr-only">(current)</span>@endif</a>
@endif
@if ($user->type->name == 'superadmin' || $user->type->name == 'admin')
                            <a class="dropdown-item @if($path == 'administratorzy')active @endif" href="{{ route('admins.index') }}" title="Administratorzy">Administratorzy @if($path == 'administratorzy')<span class="sr-only">(current)</span>@endif</a>
@endif
@if ($user->type->name == 'superadmin' || $user->type->name == 'employer')
                            <a class="dropdown-item @if($path == 'pracodawcy')active @endif" href="{{ route('employers.index') }}" title="Pracodawcy">Pracodawcy @if($path == 'pracodawcy')<span class="sr-only">(current)</span>@endif</a>
@endif
@if ($user->type->name == 'superadmin' || $user->type->name == 'worker')
                            <a class="dropdown-item @if($path == 'pracownicy')active @endif" href="{{ route('workers.index') }}" title="Pracownicy">Pracownicy @if($path == 'pracownicy')<span class="sr-only">(current)</span>@endif</a>
@endif
                        </div>
                    </li>
                    <li class="nav-item dropdown @if($path == 'legenda' || $path == 'wolne' || $path == 'wydarzenia')active @endif">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Kalendarz
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item @if($path == 'legenda')active @endif" href="{{ route('legends.index') }}" title="Typy wydarzeń">Legenda @if($path == 'legenda')<span class="sr-only">(current)</span>@endif</a>
                            <a class="dropdown-item @if($path == 'wolne')active @endif" href="{{ route('holidays.index') }}" title="Dni ustawowo wolne od pracy">Wolne @if($path == 'wolne')<span class="sr-only">(current)</span>@endif</a>
@if ($user->type->name == 'superadmin' || $user->type->name == 'admin')
                            <a class="dropdown-item @if($path == 'wydarzenia')active @endif" href="{{ route('events.index') }}" title="Wszystkie wydarzenia">Wydarzenia @if($path == 'wydarzenia')<span class="sr-only">(current)</span>@endif</a>
@endif
                        </div>
                    </li>
                </ul>
@if ($user->type->name == 'superadmin' || $user->type->name == 'admin')
                <form class="form-inline" action="{{ route('search.search') }}" method="GET">
                    <input name="co" class="form-control mr-sm-2" type="search" placeholder="Wyszukiwanie" aria-label="Wyszukiwanie" required>
                    <button class="btn btn-outline-success my-2 my-sm-0 mr-5" type="submit">Szukaj</button>
                </form>
@endif
                <form class="form-inline my-2 my-lg-0" action="{{ route('logout') }}" method="POST">
                    @csrf
                    
                    <button class="btn btn-outline-secondary btn-sm" type="submit"><i class="fas fa-sign-out-alt"></i> Wyloguj</button>
                </form>
            </div>
        </nav>
@show
