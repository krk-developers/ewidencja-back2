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
@if ($users->count() > 0)
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">L.P.</th>
                                <th scope="col">#</th>
                                <th scope="col">Imię</th>
                                <th scope="col">E-mail</th>
                                <th scope="col">Uprawnienia</th>
                                <th scope="col">Opis</th>
                            </tr>
                        </thead>
                        <tbody>
@foreach ($users as $user)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $user->id }}</td>
                                <td>
                                    <a href="{{ route('superadmins.show', $user->userable_id) }}" title="Szczegóły">
                                        {{ $user->firstname }}
                                    </a>
                                </td>
                                <td><a href="mailto:{{ $user->email }}">{{ $user->email }}</td>
                                <td>{{ $user->type_display_name }}</td>
                                <td>{{ $user->description }}</td>
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
