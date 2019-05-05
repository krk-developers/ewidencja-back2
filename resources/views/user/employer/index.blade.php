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
@if ($employers->count() > 0)
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">L.P.</th>
                                <th scope="col">#</th>
                                <th scope="col">Imię</th>
                                <th scope="col">E-mail</th>
                                <th scope="col">Nazwa firmy</th>
                                <th scope="col" class="text-center">Pracownicy</th>
                            </tr>
                        </thead>
                        <tbody>
@foreach ($employers as $employer)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $employer->id }}</td>
                                <td>
                                    <a href="{{ route('employers.show', $employer->id) }}" title="Szczegóły">
                                        <i class="fas fa-eye"></i> {{ $employer->user['name'] }}
                                    </a>
                                </td>
                                <td>
                                    <a href="mailto:{{ $employer->user['email'] }}">
                                        <i class="fas fa-paper-plane"></i> {{ $employer->user['email'] }}
                                    </a>
                                </td>
                                <td>{{ $employer->company }}</td>
                                <td class="text-center">
@if ($employer->workers->count() > 0)
                                    <span class="badge badge-warning">{{ $employer->workers->count() }}</span>
@else
                                    <span class="badge badge-secondary">{{ $employer->workers->count() }}</span>
@endif
                                </td>
                            </tr>
@endforeach
                        </tbody>
                    </table>
@else
                    <div class="alert alert-secondary" role="alert">Brak pracodawców</div>
@endif
                </div>
            </div>
@endsection
