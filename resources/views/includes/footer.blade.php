@section('footer')
        <div class="container-fluid">
            <div class="row mt-5">
                <div class="col-sm border-top pt-2 small text-secondary">
                        Zalogowany jako: <strong>{{ $user->name }}</strong>. Uprawnienia: <strong>{{ $user->type->display_name }}</strong>
                </div>
            </div>
        </div>
@show
