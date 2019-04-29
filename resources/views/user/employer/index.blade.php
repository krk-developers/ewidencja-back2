@extends('layouts.base')

@section('title', 'Pracodawcy')

@section('content')
            <div class="row mt-5">
                <div class="col-sm">
                    <h3><i class="fas fa-user-tie"></i> Pracodawcy</h3>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-sm">
                    <a class="btn btn-success" href="{{ route('employers.create') }}" title="Dodawanie pracodawcy" role="button">
                        <i class="fas fa-plus"></i> Dodaj
                    </a>
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
@foreach ($employers as $employer)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $employer->id }}</td>
                                <td>
                                    <a href="{{ route('employers.show', $employer->userable_id) }}" title="">
                                        <i class="fas fa-eye"></i> {{ $employer->name }}
                                    </a>
                                </td>
                                <td>
                                    <a href="mailto:{{ $employer->email }}">
                                        <i class="fas fa-paper-plane"></i> {{ $employer->email }}
                                    </a>
                                </td>
                                <td>{{ $employer->type->display_name }}</td>
                                <td>{{ $employer->type->description }}</td>
                            </tr>
@endforeach
                        </tbody>
                    </table>
                </div>
            </div>
@endsection
