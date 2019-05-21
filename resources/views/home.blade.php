@extends('layouts.base')

@section('title', 'Strona główna')

@section('content')
            <div class="row">
                <div class="col-sm">
                    <div class="jumbotron jumbotron-fluid">
                        <h1 class="display-1 text-center">ewipAnel</h1>
                        <h1 class="display-5">{{ $user->name }}</h1>
                        <p class="lead">Uprawnienia: {{ $user->type->display_name }}</p>
                        <hr class="my-4">
                        <p>
                            Możesz korzystać z programu wybierając interesujący Cię dział z menu lub przejść na:
                            <a class="btn btn-primary btn-sm" href="https://ewidencja.vipserv.org/" role="button">
                                <i class="fas fa-home"></i> Stronę główną
                            </a>
                        </p>
                        <hr>
                        <p class="text-muted">
                            <small>
                                <div>Zalecana rozdzielczość w poziomie >= 768 pikseli.</div>
                                <ul class="list-inline">
                                    <li class="list-inline-item">Przetestowano w przeglądarkach:</li>
                                    <li class="list-inline-item"><a href="https://www.mozilla.org/pl/firefox/" title=""><i class="fas fa-external-link-alt"></i> Firefox</a></li>
                                    <li class="list-inline-item"><a href="https://www.google.pl/chrome/" title=""><i class="fas fa-external-link-alt"></i> Chrome</a></li>
                                    <li class="list-inline-item"><a href="https://www.opera.com/pl" title=""><i class="fas fa-external-link-alt"></i> Opera</a></li>
                                    <li class="list-inline-item"><a href="https://vivaldi.com/pl/" title=""><i class="fas fa-external-link-alt"></i> Vivaldi</a></li>
                                </ul>
                            </small>
                        </p>
                    </div>
                </div>
            </div>
@endsection
