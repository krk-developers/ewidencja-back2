@extends('layouts.base')

@section('title', 'Wydarzenia')

@section('content')
            <div class="row mt-5">
                <div class="col-sm">
                    <h3><i class="fas fa-user"></i> Wydarzenia. Pracownik: {{ $worker->user->name }} {{ $worker->lastname }}</h3>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-sm">
                    <h4>
                        Liczba przepracowanych dni: {{ $worked_days }} 
                        <small class="text-muted">(po odliczeniu weekendów i nieobecności)</small>
                    </h4>
                </div>
            </div>
            {{--
            <div class="row mt-5">
                <div class="col-sm">
                    <a class="btn btn-success" href="{{ route('workers.create') }}" title="Dodawanie pracownika" role="button">
                        <i class="fas fa-user-plus"></i> Dodaj
                    </a>
                </div>
            </div>
            --}}
            <div class="row mt-3">
                <div class="col-sm">
@if ($worker->events->count() > 0)
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">L.P.</th>
                                <th scope="col">#</th>
                                <th scope="col">Nazwa</th>
                                <th scope="col">Początek</th>
                                <th scope="col">Koniec</th>
                                <th scope="col">Legenda skrót</th>
                                <th scope="col">Legenda pełna nazwa</th>
                            </tr>
                        </thead>
                        <tbody>
@foreach ($worker->events as $event)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $event->id }}</td>
                                <td>
                                    <a href="{{ route('workers.events.show', [$worker->id, $event->id]) }}" title="Szczegóły">
                                        <i class="fas fa-eye"></i>
                                        {{ $event->title }}
                                    </a>
                                </td>
                                <td>{{ $event->start }}</td>
                                <td>{{ $event->end }}</td>
                                <td>{{ $event->legend->name }}</td>
                                <td>{{ $event->legend->display_name }}</td>
                            </tr>
@endforeach
                        </tbody>
                    </table>
@else
                    <div class="alert alert-secondary" role="alert">Brak wydarzeń</div>
@endif
                    <a href="{{ route('workers.show', $worker->id) }}" title="Powrót do poprzedniej strony" class="btn btn-light">
                        <i class="fas fa-angle-left"></i> Powrót
                    </a>
                </div>
            </div>
@endsection
