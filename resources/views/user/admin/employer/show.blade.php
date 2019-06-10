@extends('layouts.base')

@section('title', 'Pracodawca ' . $employer->company)

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
                                                                <a href="{{ route('admins.employers.workers.show', [$admin->id, $employer->id, $worker->id]) }}" data-placement="top" title="Szczegóły">
                                                                    <i class="fas fa-user"></i>
                                                                    {{ $worker->user->name }} {{ $worker->lastname }}. PESEL: {{ $worker->pesel }}
                                                                </a>
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
                                                <a href="{{ route('employers.records.index', [$employer, $year_month, 'admin' => $admin->id]) }}" title="Szczegóły">
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
                            <form action="{{ route('admins.employers.destroy', [$admin, $employer]) }}" method="POST">
                                @csrf

                                @method('DELETE')
                                
                                <a href="{{ route('admins.employers.index', $admin) }}" title="Powrót do poprzedniej strony" class="btn btn-light">
                                    <i class="fas fa-angle-left"></i> Powrót
                                </a>
                                <a href="{{ route('admins.employers.edit', [$admin, $employer]) }}" title="Edycja" class="btn btn-primary">
                                    <i class="fas fa-edit"></i> Edytuj
                                </a>
                                <button type="submit" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Usuwa z listy swoich pracodawców">
                                    <i class="fas fa-eraser"></i> Usuń z listy
                                </button>
                                <a href="{{ route('admins.employers.workers.create', [$admin, $employer]) }}" title="Dodawanie pracownika" class="btn btn-success">
                                    <i class="fas fa-user-plus"></i> Dodaj pracownika
                                </a>
                            </form>
                        </footer>
                    </div>
                </div>
            </div>
@endsection
