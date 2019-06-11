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
                                                <a href="mailto:{{ $worker->user->email }}" data-toggle="tooltip" data-placement="top" title="Wysyła e-mail">
                                                    <i class="fas fa-paper-plane"></i> {{ $worker->user->email }}
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">
                                                <span data-toggle="tooltip" data-placement="top" title="{{ $worker->user->type->description }}">
                                                    Uprawnienia
                                                </span>
                                            </th>
                                            <td>
                                                <span data-toggle="tooltip" data-placement="top" title="{{ $worker->user->type->description }}">
                                                    {{ $worker->user->type->display_name }}
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Pracodawca</th>
                                            <td>
                                                <a href="{{ route('workers.employers.show', [$worker->id, $employer->id]) }}" data-toggle="tooltip" data-placement="top" title="Szczegóły umowy">
                                                    <i class="fas fa-industry"></i>
                                                    {{ $employer->company }}
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Ekwiwalent</th>
                                            <td>
@if ($worker->equivalent == 0)
                                                Nie
@else
                                                Tak
@endif
                                            </td>
                                        </tr>
@if ($worker->equivalent_amount > 0)
                                        <tr>
                                            <th scope="row">Kwota ekwiwalentu</th>
                                            <td>{{ $worker->equivalent_amount }} PLN</td>
                                        </tr>
@endif
                                        <tr>
                                            <th scope="row">Etat efektywny</th>
                                            <td>{{ $worker->effective }}</td>
                                        </tr>
@if ($worker->events->count() > 0)
                                        <tr>
                                            <th scope="row">Wydarzenia</th>
                                            <td>
                                                <a href="{{ route('workers.events.index', $worker->id) }}" data-toggle="tooltip" data-placement="top" title="Szczegóły">
                                                    <i class="fas fa-eye"></i> Wszystkie
                                                </a>
                                                <span class="badge badge-warning">{{ $worker->events->count() }}</span>
                                            </td>
                                        </tr>
@endif
                                        <tr>
                                            <th scope="row">Ewidencja</th>
                                            <td>
                                                <a href="{{ route('workers.records.index', [$worker, $employer, $year_month, 'admin' => $admin->id]) }}" title="Szczegóły">
                                                    <i class="fas fa-align-justify"></i>  Ewidencja. Miesiąc {{ $month_name }}
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                        </div>
                        <footer class="card-footer bg-white">
                            <form action="{{ route('admins.employers.workers.destroy', [$admin, $employer, $worker]) }}" method="POST">
                                @csrf

                                @method('DELETE')

                                <a href="{{ route('admins.employers.show', [$admin, $employer]) }}" title="Powrót do poprzedniej strony" class="btn btn-light">
                                    <i class="fas fa-angle-left"></i> Powrót
                                </a>
                                <a href="{{ route('admins.employers.workers.edit', [$admin->id, $employer->id, $worker->id]) }}" title="Edycja" class="btn btn-primary">
                                    <i class="fas fa-user-edit"></i> Edytuj
                                </a>
                                <button type="submit" class="btn btn-danger" title="Usuwa pracownika z listy zatrudnionych">
                                    <i class="fas fa-eraser"></i> Zwolnij
                                </button>
                                <a href="{{ route('admins.employers.workers.employers.add', [$admin, $employer, $worker]) }}" title="Dodawanie pracodawcy do list pracownika" class="btn btn-success">
                                    <i class="fas fa-plus"></i> Dodaj pracodawcę
                                </a>
                            </form>
                        </footer>
                    </div>
                </div>
            </div>
@endsection
