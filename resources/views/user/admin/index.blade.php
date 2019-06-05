@extends('layouts.base')

@section('title', 'Administatorzy')

@section('content')
            <div class="row mt-5">
                <div class="col-sm">
                    <h3><i class="fas fa-user-cog"></i> Administratorzy</h3>
                </div>
            </div>
@can('create', App\Admin::class)
            <div class="row mt-5">
                <div class="col-sm">
                    <a class="btn btn-success" href="{{ route('admins.create') }}" title="Dodawanie Administratora" role="button">
                        <i class="fas fa-plus"></i> Dodaj
                    </a>
                </div>
            </div>
@endcan
            <div class="row mt-3">
                <div class="col-sm">
@if ($admins->count() > 0)
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
@foreach ($admins as $admin)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $admin->id }}</td>
                                <td>
                                    <a href="{{ route('admins.show', $admin->id) }}" title="Szczególy">
                                        <i class="fas fa-eye"></i> {{ $admin->user['name'] }}
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('admins.show', $admin->id) }}" title="Szczególy">
                                        <i class="fas fa-eye"></i> {{ $admin->lastname }}
                                    </a>
                                </td>
                                <td>
                                    <a href="mailto:{{ $admin->user['email'] }}" title="Wysyła e-mail">
                                        <i class="fas fa-paper-plane"></i> {{ $admin->user['email'] }}
                                    </a>
                                </td>
                            </tr>
@endforeach
                        </tbody>
                    </table>
@else
                    <div class="alert alert-secondary" role="alert">Brak Administratorów</div>
@endif
                </div>
            </div>
@endsection
