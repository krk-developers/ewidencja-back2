@extends('layouts.base')

@section('title', $event->title)

@section('content')
            <div class="row mt-5">
                <div class="col-sm">
                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-calendar-day"></i>
                            Wydarzenie
                            <i class="fas fa-user"></i>
                            {{ $worker->user->name }} {{ $worker->lastname }}.
                            PESEL: {{ $worker->pesel }}
                            <i class="fas fa-user-tie"></i>
                            {{ $employer->company }}
                        </div>
                        <div class="card-body">
                            <p class="card-text">
                                <table class="table">
                                        <tr>
                                            <th scope="row">#</th>
                                            <td>{{ $event->id }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Nazwa</th>
                                            <td>{{ $event->title }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Początek</th>
                                            <td>{{ $event->start }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Koniec</th>
                                            <td>{{ $event->end }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Legenda &mdash; skrót</th>
                                            <td>{{ $event->legend->name }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Legenda &mdash; nazwa</th>
                                            <td>{{ $event->legend->display_name }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Legenda &mdash; opis</th>
                                            <td>{{ $event->legend->description }}</td>
                                        </tr>
                                </table>
                            </p>
                        </div>
                        <footer class="card-footer bg-white">
                            <form action="{{ route('workers.employers.events.destroy', [$worker->id, $employer->id, $event->id, $year_month]) }}" method="POST">
                                @csrf

                                @method('DELETE')

                                <a href="{{ route('workers.employers.events.index', [$worker->id, $employer->id, $year_month]) }}" title="Powrót do poprzedniej strony" class="btn btn-light">
                                    <i class="fas fa-angle-left"></i> Powrót
                                </a>
                                <a href="{{ route('workers.employers.events.edit', [$worker->id, $employer->id, $event->id, $year_month]) }}" title="Edycja" class="btn btn-primary">
                                    <i class="fas fa-edit"></i> Edytuj
                                </a>
                                <button type="submit" class="btn btn-danger">
                                    <i class="fas fa-calendar-minus"></i> Usuń
                                </button>
                            </form>
                        </footer>
                    </div>
                </div>
            </div>
@endsection
