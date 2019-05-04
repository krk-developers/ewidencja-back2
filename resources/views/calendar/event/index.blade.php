@extends('layouts.base')

@section('title', 'Wydarzenia')

@section('content')
            <div class="row mt-5">
                <div class="col-sm">
                    <h3><i class="fas fa-calendar-alt"></i> Wszystkie wydarzenia</h3>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-sm">
                    <a class="btn btn-success" href="{{ route('events.create') }}" title="Dodawanie wydarzenia" role="button">
                        <i class="fas fa-calendar-plus"></i> Dodaj
                    </a>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-sm">
@if ($events->count() > 0)
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">L.P.</th>
                                <th scope="col">#</th>
                                <th scope="col">Nazwa</th>
                                <th scope="col">Skrót</th>
                                <th scope="col">Początek</th>
                                <th scope="col">Koniec</th>
                                <th scope="col">Imię</th>
                                <th scope="col">Nazwisko</th>
                                <th scope="col">Pesel</th>
                                <th scope="col">E-mail</th>
                            </tr>
                        </thead>
                        <tbody>
@foreach ($events as $event)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $event->id }}</td>
                                <td>
                                    <a href="{{ route('events.show', $event->id) }}" title="Szczegóły">
                                        <i class="fas fa-eye"></i> {{ $event->title }}
                                    </a>
                                </td>
                                <td>
                                    <span data-toggle="tooltip" data-placement="top" title="{{ $event->legend_display_name }}">
                                        {{ $event->legend_name }}
                                    </span>
                                </td>
                                <td>{{ $event->start }}</td>
                                <td>{{ $event->end }}</td>
                                <td>
                                    <a href="{{ route('workers.show', $event->worker_id) }}" title="Szczegóły">
                                        <i class="fas fa-eye"></i> {{ $event->firstname }}
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('workers.show', $event->worker_id) }}" title="Szczegóły">
                                        <i class="fas fa-eye"></i> {{ $event->lastname }}
                                    </a>
                                </td>
                                <td>{{ $event->pesel }}</td>
                                <td>
                                    <a href="mailto:{{ $event->email }}" title="Wysyła e-mail">
                                        <i class="fas fa-paper-plane"></i> {{ $event->email }}
                                    </a>
                                </td>
                            </tr>
@endforeach
                        </tbody>
                    </table>
@else
                    <div class="alert alert-secondary" role="alert">Brak wydarzeń</div>
@endif
                </div>
            </div>
@endsection
