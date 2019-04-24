@extends('layouts.base')

@section('title', 'Pracownicy')

@section('content')
            <div class="row mt-5">
                <div class="col-sm">
                    <h3><i class="fas fa-user"></i> Pracownicy</h3>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-sm">
                    <a class="btn btn-success" href="{{ route('workers.create') }}" title="Dodawanie pracownika" role="button">
                        <i class="fas fa-user-plus"></i> Dodaj
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
                                <td><a href="{{ route('workers.show', $user->userable_id) }}" title=""><i class="fas fa-eye"></i> {{ $user->firstname }}</a></td>
                                <td><a href="mailto:{{ $user->email }}">{{-- <i class="fas fa-external-link-alt"></i> --}}<i class="fas fa-paper-plane"></i> {{ $user->email }}</a></td>
                                <td>{{ $user->type_display_name }}</td>
                                <td>{{ $user->description }}</td>
                            </tr>
@endforeach
                        </tbody>
                    </table>
@else
                    <div class="alert alert-secondary" role="alert">Brak pracowników</div>
@endif
                </div>
            </div>
@endsection
