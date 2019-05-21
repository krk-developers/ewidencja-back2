@extends('layouts.base')

@section('title', 'Strona główna')

@section('content')
            <div class="row">
                <div class="col-sm">
                    <div class="jumbotron jumbotron-fluid">
                        <h1 class="display-5">{{ $user->name }}</h1>
                        <p class="lead">Uprawnienia: {{ $user->type->display_name }}</p>
                        <hr class="my-4">
                        <p>Możesz korzystać z programu wybierając interesujący Cię dział z menu lub przejść na:</p>
                        <a class="btn btn-primary" href="https://ewidencja.vipserv.org/" role="button"><i class="fas fa-home"></i> Stronę główną</a>
                    </div>
                </div>
            </div>
@endsection
