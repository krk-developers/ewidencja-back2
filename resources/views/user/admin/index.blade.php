@extends('layouts.base')

@section('title', 'Administatorzy')

@section('content')
            <div class="row mt-5">
                <div class="col-sm">
                    <h3><i class="fas fa-user-cog"></i> Administratorzy</h3>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-sm">
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
                                <td>{{ $user->firstname }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->type_display_name }}</td>
                                <td>{{ $user->description }}</td>
                            </tr>
@endforeach
                        </tbody>
                    </table>
                </div>
            </div>
@endsection
