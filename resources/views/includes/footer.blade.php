@section('footer')
        <div class="container-fluid">
            <div class="row mt-5">
                <div class="col-sm border-top pt-2 small text-secondary">
                        Zalogowany jako: <strong>{{ $user->name }}</strong>. 
                        Uprawnienia: <strong>{{ $user->type->display_name }}</strong>.
@if (App::environment('local'))
                        Ścieżka: <strong>{{ $path }}</strong>.
                        Route action: <strong>{{ Route::currentRouteAction() }}</strong>.
                        Route name: <strong>{{ Route::currentRouteName() }}</strong>.
                        Środowisko: <strong>{{ App::environment() }}</strong>.
@else
                        Aplikacja wykorzystuje <i class="fas fa-cookie"></i> ciastka.
@endif
                </div>
            </div>
        </div>
@show
