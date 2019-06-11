@extends('layouts.base')

@section('title', 'Pracodawca')

@section('content')
            <div class="row mt-5">
                <div class="col-sm">
                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-user-tie"></i> Pracodawca
                        </div>
                        <div class="card-body">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <th scope="row">Imię</th>
                                            <td>{{ $employer->user->name }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">E-mail</th>
                                            <td>
                                                <a href="{{ $employer->user->email }}" title="Wysyła e-mail">
                                                    <i class="fas fa-paper-plane"></i>
                                                    {{ $employer->user->email }}
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Nazwa firmy</th>
                                            <td><i class="fas fa-industry"></i> {{ $employer->company }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">NIP</th>
                                            <td>{{ $employer->nip }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Ulica i numer</th>
                                            <td>{{ $employer->street }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Kod pocztowy i miasto</th>
                                            <td>{{ $employer->zip_code }} {{ $employer->city }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Województwo</th>
                                            <td>@isset($employer->province){{ $employer->province->name }}@endisset</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">
                                                <span data-toggle="tooltip" data-placement="top" title="{{ $employer->user->type->description }}">
                                                    Uprawnienia
                                                </span>
                                            </th>
                                            <td>
                                                <span data-toggle="tooltip" data-placement="top" title="{{ $employer->user->type->description }}">
                                                    {{ $employer->user->type->display_name }}
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Pracownicy</th>
                                            <td>
@if ($employer->workers->count() > 0)
                                                <table class="table table-bordered">
                                                    <tbody>
@foreach ($employer->workers as $worker)
                                                        <tr>
                                                            <td>
@if (Auth::user()->type->name === 'employer')
                                                                <a href="{{ route('employers.workers.show', [$employer, $worker]) }}" title="Szczegóły">
                                                                    <i class="fas fa-user"></i>
                                                                    {{ $worker->user->name }} {{ $worker->lastname }}. PESEL: {{ $worker->pesel }}
                                                                </a>
@else
                                                                <a href="{{ route('workers.show', $worker->id) }}" title="Szczegóły">
                                                                    <i class="fas fa-user"></i>
                                                                    {{ $worker->user->name }} {{ $worker->lastname }}. PESEL: {{ $worker->pesel }}
                                                                </a>
@endif
                                                            </td>
                                                            <td>
                                                                <form action="{{ route('employers.workers.fired', [$employer, $worker]) }}" class="form-inline" method="POST">
                                                                    @csrf

                                                                    @method('DELETE')

                                                                    <button type="submit" class="btn btn-outline-danger btn-sm" title="Usuwa pracownika z listy zatrudnionych">
                                                                        <i class="fas fa-eraser"></i> Zwolnij
                                                                    </button>
                                                                </form>
                                                            </td>
                                                        </tr>
@endforeach
                                                    </tbody>
                                                </table>
@else
                                                <div class="alert alert-secondary" role="alert">
                                                    <i class="fas fa-user-slash"></i> Brak pracowników
                                                </div>
@endif
                                            </td>
                                        </tr>
@if ($employer->workers->count() > 0)
                                        <tr>
                                            <th scope="row">Ewidencja zbiorcza</th>
                                            <td>
                                                <a href="{{ route('employers.records.index', [$employer->id, $year_month]) }}" title="Szczegóły">
                                                    <i class="fas fa-align-justify"></i>
                                                    Miesiąc {{ $month_name }}
                                                </a>
                                            </td>
                                        </tr>
@endif
                                    </tbody>
                                </table>
                        </div>
                        <footer class="card-footer bg-white">
                            <form action="{{ route('employers.destroy', $employer->id) }}" method="POST">
                                @csrf

                                @method('DELETE')

{{-- @can('showEmployersList', $employer) --}}
                                <a href="{{ route('employers.index') }}" title="Powrót do poprzedniej strony" class="btn btn-light">
                                    <i class="fas fa-angle-left"></i> Powrót
                                </a>
{{-- @endcan --}}
                                <a href="{{ route('employers.edit', $employer->id) }}" title="Edycja" class="btn btn-primary">
                                    <i class="fas fa-edit"></i> Edytuj
                                </a>
                                <button type="submit" class="btn btn-danger">
                                    <i class="fas fa-eraser"></i> Usuń
                                </button>
@can('addWorker', $employer)
                                <a href="{{ route('employers.workers.create', $employer->id) }}" title="Dodawanie pracownika" class="btn btn-success">
                                    <i class="fas fa-user-plus"></i> Dodaj pracownika
                                </a>
@endcan
                            </form>
                        </footer>
                    </div>
                </div>
            </div>
@endsection
