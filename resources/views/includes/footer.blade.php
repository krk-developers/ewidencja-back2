@section('footer')
        <div class="container-fluid">
            <div class="row mt-5">
                <div class="col-sm border-top pt-2 small text-secondary">
                        <strong>{{ $user->name }}</strong>.                        
                        <strong>{{ $user->type->display_name }}</strong>
                        &bull;
@if (App::environment('local'))
                        {{-- Ścieżka: <strong>{{ $path }}</strong>. --}}
                        Route action: <strong>{{ Route::currentRouteAction() }}</strong>.
                        Route name: <strong>{{ Route::currentRouteName() }}</strong>.
                        Env: <strong>{{ App::environment() }}</strong>.
                        {{-- Produkcja: {{ App::isProduction() }} --}}
@else
                        Aplikacja wykorzystuje <i class="fas fa-cookie"></i> ciastka
                        &bull;
                        Wersja 0.0.1
@endif
                </div>
            </div>
        </div>
@show
