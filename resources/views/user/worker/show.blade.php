@extends('layouts.base')

@section('title', $worker->user->name . ' ' .$worker->lastname)

@section('content')
            <div class="row mt-5">
                <div class="col-sm">
                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-user"></i> Pracownik
                        </div>
                        <div class="card-body">
                            <p class="card-text">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <th scope="row">Imię</th>
                                            <td>{{ $worker->user->name }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Nazwisko</th>
                                            <td>{{ $worker->lastname }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">
                                                <abbr title="Powszechny Elektroniczny System Ewidencji Ludności">
                                                    PESEL
                                                </abbr>
                                            </th>
                                            <td>{{ $worker->pesel }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">E-mail</th>
                                            <td>
                                                <a href="mailto:{{ $worker->user->email }}" title="Wysyła e-mail">
                                                    <i class="fas fa-paper-plane"></i> {{ $worker->user->email }}
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Uprawnienia</th>
                                            <td>{{ $worker->user->type->display_name }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Opis</th>
                                            <td>{{ $worker->user->type->description }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Pracodawca</th>
                                            <td>
                                                <ul class="list-group list-group-flush">
@forelse ($worker->employers as $employer)
                                                    <li class="list-group-item">
                                                        <a href="{{ route('employers.show', $employer->id) }}" title="Szczegóły">
                                                            <i class="fas fa-industry"></i> {{ $employer->company }}
                                                        </a>
                                                        <form action="{{ route('workers.employers.destroy', [$worker->id, $employer->id]) }}" class="form-inline" method="POST">
                                                            @csrf

                                                            @method('DELETE')

                                                            <button type="submit" class="btn btn-outline-danger btn-sm">
                                                                <i class="fas fa-eraser"></i> Usuń
                                                            </button>
                                                        </form>
                                                    </li>
@empty
                                                    <li class="list-group-item text-danger">
                                                        <i class="fas fa-times"></i> Brak zatrudnienia
                                                    </li>
@endforelse
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Wydarzenia</th>
                                            <td>
                                                <a href="{{ route('workers.events.index', $worker->id) }}" title="Szczegóły">
                                                    <i class="fas fa-eye"></i> Wszystkie
                                                </a>
@if ($worker->events->count() > 0)
                                                <span class="badge badge-warning">{{ $worker->events->count() }}</span>
@else
                                                <span class="badge badge-secondary">{{ $worker->events->count() }}</span>
@endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Ewidencja</th>
                                            <td>
                                                <a href="{{ route('workers.records.index', [$worker->id, $year_month]) }}" title="{{ $year_month }}">
                                                    <i class="fas fa-eye"></i> Ewidencja. Miesiąc {{ $month_name }}
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </p>
                        </div>
                        <footer class="card-footer bg-white">
                            <form action="{{ route('workers.destroy', $worker->id) }}" method="POST">
                                @csrf

                                @method('DELETE')

                                <a href="{{ route('workers.index') }}" title="Powrót do poprzedniej strony" class="btn btn-light">
                                    <i class="fas fa-angle-left"></i> Powrót
                                </a>
                                <a href="{{ route('workers.edit', $worker->id) }}" title="Edycja" class="btn btn-primary">
                                    <i class="fas fa-user-edit"></i> Edytuj
                                </a>
                                <button type="submit" class="btn btn-danger">
                                    <i class="fas fa-eraser"></i> Usuń
                                </button>
                                <a href="{{ route('workers.employers.add', $worker->id) }}" title="Dodawanie pracodawcy" class="btn btn-success">
                                    <i class="fas fa-plus"></i> Dodaj pracodawcę
                                </a>
                            </form>
                        </footer>
                    </div>
                </div>
            </div>
@endsection
