@extends('layouts.base')

@section('title', 'Pracownicy')

@section('content')
            <div class="row mt-5">
                <div class="col-sm">
                    <h3><i class="fas fa-user"></i> Pracownicy</h3>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-sm">
                    <a class="btn btn-success" href="{{ route('workers.create') }}" title="Dodawanie pracownika" role="button">
                        <i class="fas fa-user-plus"></i> Dodaj
                    </a>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-sm">
@if ($workers->count() > 0)
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">L.P.</th>
                                <th scope="col">#</th>
                                <th scope="col">Imię</th>
                                <th scope="col">Nazwisko</th>
                                <th scope="col">E-mail</th>
                                <th scope="col">Pesel</th>
                                <th scope="col" class="text-center">Pracodawcy</th>
                                <th scope="col" class="text-center">Wydarzenia</th>
                            </tr>
                        </thead>
                        <tbody>
@foreach ($workers as $worker)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $worker->id }}</td>
                                <td>
                                    <a href="{{ route('workers.show', $worker->id) }}" title="Szczegóły">
                                        <i class="fas fa-eye"></i> {{ $worker->user->name }}</td>
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('workers.show', $worker->id) }}" title="Szczegóły">
                                        <i class="fas fa-eye"></i> {{ $worker->lastname }}
                                    </a>
                                </td>
                                <td>
                                    <a href="mailto:{{ $worker->user->email }}" title="Wysyła e-mail">
                                        <i class="fas fa-paper-plane"></i> {{ $worker->user->email }}
                                    </a>
                                </td>
                                <td>{{ $worker->pesel }}</td>
                                <td class="text-center">
@if ($worker->employers->count() > 0)
                                    <span class="badge badge-warning">{{ $worker->employers->count() }}</span>
@else
                                    <span class="badge badge-secondary">{{ $worker->employers->count() }}</span>
@endif
                                </td>
                                <td class="text-center">
@if ($worker->events->count() > 0)
                                    <span class="badge badge-warning">{{ $worker->events->count() }}</span>
@else
                                    <span class="badge badge-secondary">{{ $worker->events->count() }}</span>
@endif
                                </td>
                            </tr>
@endforeach
                        </tbody>
                    </table>
@else
                    <div class="alert alert-secondary" role="alert">Brak pracowników</div>
@endif
                </div>
            </div>
@endsection
