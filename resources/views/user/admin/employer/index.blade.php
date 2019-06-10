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
                    <a class="btn btn-success" href="{{ route('admins.employers.create', $admin->id) }}" data-toggle="tooltip" data-placement="top" title="Dodaje do listy swoich pracodawców" role="button">
                        <i class="fas fa-plus"></i> Dodaj do listy
                    </a>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-sm">
@if ($admin->employers->count() > 0)
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">L.P.</th>
                                <th scope="col">#</th>
                                <th scope="col">Nazwa</th>
                                <th scope="col">NIP</th>
                                <th scope="col">Ulica</th>
                                <th scope="col">Kod pocztowy i miasto</th>
                                <th scope="col">Województwo</th>
                                <!--
                                <th scope="col" class="text-center">Pracodawcy</th>
                                <th scope="col" class="text-center">Wydarzenia</th>
                                -->
                            </tr>
                        </thead>
                        <tbody>
@foreach ($admin->employers as $employer)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $employer->id }}</td>
                                <td>
                                    <a href="{{ route('admins.employers.show', [$admin->id, $employer->id]) }}" title="Szczegóły">
                                        <i class="fas fa-eye"></i>
                                        {{ $employer->company }}
                                    </a>
                                </td>
                                <td>{{ $employer->nip }}</td>
                                <td>{{ $employer->street }}</td>
                                <td>{{ $employer->zip_code }} {{ $employer->city }}</td>
                                <td>{{ $employer->province['name'] }}</td>
                            </tr>
@endforeach
                        </tbody>
                    </table>
@else
                    <div class="alert alert-secondary" role="alert">Brak pracodawców</div>
@endif
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-sm">
                    <a class="btn btn-light" href="{{ route('admins.show', $admin->id) }}" title="Powrót" role="button">
                        <i class="fas fa-angle-left"></i> Powrót
                    </a>
                </div>
            </div>
@endsection
