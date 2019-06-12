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
                                                <a href="mailto:{{ $worker->user->email }}" title="Wysyła e-mail">
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
@if ($worker->employers->count() > 0)
                                                <table class="table table-bordered">
                                                    <tbody>
@foreach ($worker->employers as $employer)
                                                        <tr>
                                                            <td>
                                                                <a href="{{ route('workers.employers.show', [$worker->id, $employer->id]) }}" title="Szczegóły">
                                                                    <i class="fas fa-industry"></i> {{ $employer->company }}
                                                                </a>
                                                            </td>
                                                            <td>
                                                                <form action="{{ route('workers.employers.destroy', [$worker->id, $employer->id]) }}" class="form-inline" method="POST">
                                                                    @csrf

                                                                    @method('DELETE')

                                                                    <button type="submit" class="btn btn-outline-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Pracownik już nie pracuje u tego pracodawcy">
                                                                        <i class="fas fa-eraser"></i> Usuń
                                                                    </button>
                                                                </form>
                                                            </td>

                                                            <td>
                                                                <a href="{{ route('workers.employers.events.index', [$worker->id, $employer->id, $year_month]) }}" title="Szczegóły">
                                                                    <i class="fas fa-calendar-alt"></i> Wydarzenia. Miesiąc {{ $month_name }}
                                                                </a>
                                                                {{-- $worker->events --}}
                                                                {{--
                                                                <a class="btn btn-success" href="{{ route('workers.events.create', [$worker->id, $employer->id]) }}" title="Dodawanie wydarzenia dla pracownika u pracodawcy" role="button">
                                                                    <i class="fas fa-calendar-plus"></i> Dodaj wydarzenie
                                                                </a>
                                                                --}}
                                                            </td>
                                                            <td>
                                                                <a href="{{ route('workers.records.index', [$worker->id, $employer->id, $year_month]) }}" title="Szczegóły">
                                                                    <i class="fas fa-align-justify"></i>  Ewidencja. Miesiąc {{ $month_name }}
                                                                </a>
                                                            </td>
                                                        </tr>
@endforeach
                                                    </tbody>
                                                </table>
@else
                                                <div class="alert alert-secondary" role="alert">
                                                    {{-- <i class="fas fa-times"></i> --}} 
                                                    <i class="fas fa-pray"></i> Brak zatrudnienia
                                                </div>
@endif
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
                                                <a href="{{ route('workers.events.index', $worker->id) }}" title="Szczegóły">
                                                    <i class="fas fa-eye"></i> Wszystkie
                                                </a>
                                                <span class="badge badge-warning">{{ $worker->events->count() }}</span>
                                            </td>
                                        </tr>
@endif
                                        {{--
                                        <tr>
                                            <th scope="row">Ewidencja</th>
                                            <td>
                                                <a href="{{ route('workers.records.index', [$worker->id, $year_month]) }}" title="{{ $year_month }}">
                                                    <i class="fas fa-eye"></i> Ewidencja. Miesiąc {{ $month_name }}
                                                </a>
                                            </td>
                                        </tr>
                                        --}}
                                    </tbody>
                                </table>
                        </div>
                        <footer class="card-footer bg-white">
                            <form action="{{ route('workers.destroy', $worker->id) }}" method="POST">
                                @csrf

                                @method('DELETE')

@can('list', $worker)
                                <a href="{{ route('workers.index') }}" title="Powrót do poprzedniej strony" class="btn btn-light">
                                    <i class="fas fa-angle-left"></i> Powrót
                                </a>
@endcan
@can('update', $worker)
                                <a href="{{ route('workers.edit', $worker->id) }}" title="Edycja" class="btn btn-primary">
                                    <i class="fas fa-user-edit"></i> Edytuj
                                </a>
@endcan
@can('delete', $worker)
                                <button type="submit" class="btn btn-danger" title="Usuwa pracownika i jego wszystkie wydarzenia">
                                    <i class="fas fa-eraser"></i> Usuń
                                </button>
@endcan
@can('addEmployer', $worker)
                                <a href="{{ route('workers.employers.add', $worker->id) }}" title="Dodawanie pracodawcy" class="btn btn-success">
                                    <i class="fas fa-plus"></i> Dodaj pracodawcę
                                </a>
@endcan
                            </form>
                        </footer>
                    </div>
                </div>
            </div>
@endsection
