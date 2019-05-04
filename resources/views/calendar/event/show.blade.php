@extends('layouts.base')

@section('title', $event->title)

@section('content')
            <div class="row mt-5">
                <div class="col-sm">
                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-calendar-day"></i>
                            Wydarzenie
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
                                        <tr>
                                            <th scope="row" colspan="2">Pracownik:</th>                                            
                                        </tr>
                                        <tr>
                                            <th scope="row">Imię</th>
                                            <td>{{ $event->worker->user->name }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Nazwisko</th>
                                            <td>{{ $event->worker->lastname }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Pesel</th>
                                            <td>{{ $event->worker->pesel }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">E-mail</th>
                                            <td>
                                                <a href="mailto:{{ $event->worker->user->email }}" title="Wysyła e-mail">
                                                    <i class="fas fa-paper-plane"></i> {{ $event->worker->user->email }}
                                                </a>
                                            </td>
                                        </tr>
                                </table>
                            </p>
                        </div>
                        <footer class="card-footer bg-white">
                            <form action="{{ route('events.destroy', $event->id) }}" method="POST">
                                @csrf

                                @method('DELETE')

                                <a href="{{ route('events.index', $event->id) }}" title="Powrót do poprzedniej strony" class="btn btn-light">
                                    <i class="fas fa-angle-left"></i> Powrót
                                </a>
                                <a href="{{ route('events.edit', $event->id) }}" title="Edycja" class="btn btn-primary">
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
