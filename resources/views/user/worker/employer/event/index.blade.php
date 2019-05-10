@extends('layouts.base')

@section('title', 'Wydarzenia')

@section('content')
            <div class="row mt-5">
                <div class="col-sm">
                    <h3>
                        <i class="fas fa-calendar-alt"></i>
                        {{--Wydarzenia--}} {{ $start }} &mdash; {{ $end }}
                        <i class="fas fa-user"></i>
                        {{ $worker->user->name }} {{ $worker->lastname }}.
                        PESEL: {{ $worker->pesel }}
                        <i class="fas fa-user-tie"></i>
                        {{ $employer->company }}
                    </h3>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-sm">
                    <a class="btn btn-success" href="{{ route('workers.employers.events.create', [$worker->id, $employer->id, $year_month]) }}" title="Dodawanie wydarzenia dla pracownika u pracodawcy" role="button">
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
                                <th scope="col">Początek</th>
                                <th scope="col">Koniec</th>
                                <th scope="col">Legenda skrót</th>
                                <th scope="col">Legenda pełna nazwa</th>
                            </tr>
                        </thead>
                        <tbody>
@foreach ($events as $event)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $event->id }}</td>
                                <td>
                                    <a href="{{ route('workers.employers.events.show', [$worker->id, $employer->id, $event->id, $year_month]) }}" title="Szczegóły">
                                        <i class="fas fa-eye"></i>
                                        {{ $event->title }}
                                    </a>
                                </td>
                                <td>{{ $event->start }}</td>
                                <td>{{ $event->end }}</td>
                                <td>{{ $event->legend_name }}</td>
                                <td>
                                    <span data-toggle="tooltip" data-placement="top" title="{{ $event->legend_description }}">
                                        {{ $event->legend_display_name }}
                                    </span>
                                </td>
                            </tr>
@endforeach
                        </tbody>
                    </table>
@else
                    <div class="alert alert-secondary" role="alert">Brak wydarzeń</div>
@endif
                    <div class="row mt-5">
                        <div class="col-sm">
                            <a href="{{ route('workers.employers.events.index', [$worker->id, $employer->id, $previous_month]) }}" title="{{ $previous_month }}" class="btn btn-outline-secondary btn-block" role="button">
                                <i class="fas fa-chevron-left"></i> Poprzedni miesięc
                            </a>
                        </div>
                        <div class="col-sm">
                            <a href="{{ route('workers.employers.events.index', [$worker->id, $employer->id, $next_month]) }}" title="{{ $next_month }}" class="btn btn-outline-secondary btn-block" role="button">
                                Następny miesiąc <i class="fas fa-chevron-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-sm">
                            <a href="{{ route('workers.show', $worker->id) }}" title="Powrót do poprzedniej strony" class="btn btn-light">
                                <i class="fas fa-angle-left"></i> Powrót
                            </a>
                        </div>
                    </div>
                </div>
            </div>
@endsection
