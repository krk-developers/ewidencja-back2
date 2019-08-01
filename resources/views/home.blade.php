@extends('layouts.base')

@section('title', 'Strona główna')

@section('content')
            <div class="row">
                <div class="col-sm">
                    <div class="jumbotron jumbotron-fluid">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        <h1 class="display-1 text-center">ewipAnel</h1>
                        <h1 class="display-5">{{ $user->name }}</h1>
                        <p class="lead">Uprawnienia: {{ $user->type->display_name }}</p>
                        <!--
                        <hr class="my-4">
                        <p>
                            Możesz korzystać z programu wybierając interesujący Cię dział z menu lub przejść na:
                            <a class="btn btn-primary btn-sm" href="https://ewidencja.vipserv.org/" role="button">
                                <i class="fas fa-home"></i> Stronę główną
                            </a>
                        </p>
                        -->
                        <hr>
                        <p class="text-muted">
                            <small>
                                <ul class="list-inline">
                                    <li class="list-inline-item">
                                        <a href="https://github.com/krk-developers/ewidencja-back2/wiki" title="Otwiera stronę wiki na GitHub">
                                            <i class="fab fa-wikipedia-w"></i> Wiki
                                        </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="https://github.com/krk-developers/ewidencja-back2/issues" title="Otwiera zgłoszenie błędu na GitHub">
                                            <i class="fab fa-github"></i> Zgłoś błąd
                                        </a>
                                    </li>
                                </ul>
                            </small>
                        </p>
                    </div>
                </div>
            </div>
@endsection
