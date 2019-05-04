@extends('layouts.base')

@section('title', 'Super Administatorzy')

@section('content')
            <div class="row mt-5">
                <div class="col-sm">
                    <h3><i class="fas fa-user-shield"></i> Super Administratorzy</h3>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-sm">
                    <a class="btn btn-success" href="{{ route('superadmins.create') }}" title="Dodawanie Super Administratora" role="button">
                        <i class="fas fa-plus"></i> Dodaj
                    </a>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-sm">
@if ($superadmins->count() > 0)
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">L.P.</th>
                                <th scope="col">#</th>
                                <th scope="col">Imię</th>
                                <th scope="col">Nazwisko</th>
                                <th scope="col">E-mail</th>
                            </tr>
                        </thead>
                        <tbody>
@foreach ($superadmins as $superadmin)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $superadmin->id }}</td>
                                <td>
                                    <a href="{{ route('superadmins.show', $superadmin->id) }}" title="Szczegóły">
                                        <i class="fas fa-eye"></i> {{ $superadmin->user['name'] }}
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('superadmins.show', $superadmin->id) }}" title="Szczegóły">
                                        <i class="fas fa-eye"></i> {{ $superadmin->lastname }}
                                    </a>
                                </td>
                                <td>
                                    <a href="mailto:{{ $superadmin->user['email'] }}" title="Wysyła e-mail">
                                        <i class="fas fa-paper-plane"></i> {{ $superadmin->user['email'] }}
                                    </a>
                                </td>
                            </tr>
@endforeach
                        </tbody>
                    </table>
@else
                    <div class="alert alert-secondary" role="alert">Brak Super Administratorów</div>
@endif
                </div>
            </div>
@endsection
