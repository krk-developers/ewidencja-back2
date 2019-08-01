@extends('layouts.base')

@section('title', 'Wyszukiwanie')

@section('content')
            <div class="row mt-5">
                <div class="col-sm">
                    <h3><i class="fas fa-search"></i> Wyszukiwanie</h3>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-sm">
@if ($workers->count() > 0)
                    <h4 class="mt-3"><i class="fas fa-user"></i> Pracownicy</h4>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">L.P.</th>
                                <th scope="col">#</th>
                                <th scope="col">Nazwisko</th>
                                <th scope="col">PESEL</th>
                            </tr>
                        </thead>
                        <tbody>
@foreach ($workers as $worker)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $worker->id }}</td>
                                <td>
                                    <a href="{{ route('workers.show', $worker->id) }}" title="Szczegóły">
                                        <i class="fas fa-eye"></i> {{ $worker->lastname }}
                                    </a>
                                </td>
                                <td>{{ $worker->pesel }}</td>
                            </tr>
@endforeach
                        </tbody>
                    </table>
@else
                    <div class="alert alert-secondary" role="alert">Brak pracowników spełniających kryteria wyszukiwania</div>
@endif

@if ($employers->count() > 0)
                    <h4 class="pt-3"><i class="fas fa-user-tie"></i> Pracodawcy</h4>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">L.P.</th>
                                <th scope="col">#</th>
                                <th scope="col">Nazwa firmy</th>
                                <th scope="col">NIP</th>
                            </tr>
                        </thead>
                        <tbody>
@foreach ($employers as $employer)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $employer->id }}</td>
                                <td>
                                    <a href="{{ route('employers.show', $employer->id) }}" title="Szczegóły">
                                        <i class="fas fa-eye"></i> {{ $employer->company }}
                                    </a>
                                </td>
                                <td>{{ $employer->nip }}</td>
                            </tr>
@endforeach
                        </tbody>
                    </table>
@else
                    <div class="alert alert-secondary" role="alert">Brak pracodawców spełniających kryteria wyszukiwania</div>
@endif

@if ($legends->count() > 0)
                    <h4 class="pt-3"><i class="fas fa-calendar"></i> Legenda</h4>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">L.P.</th>
                                <th scope="col">#</th>
                                <th scope="col">Skrót</th>
                                <th scope="col">Nazwa</th>
                                <th scope="col">Opis</th>
                            </tr>
                        </thead>
                        <tbody>
@foreach ($legends as $legend)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $legend->id }}</td>
                                <td>{{ $legend->name }}</td>
                                <td>
                                    <a href="{{ route('legends.show', $legend->id) }}" title="Szczegóły">
                                        <i class="fas fa-eye"></i> {{ $legend->display_name }}
                                    </a>
                                </td>
                                <td>{{ $legend->description }}</td>
                            </tr>
@endforeach
                        </tbody>
                    </table>
@else
                    <div class="alert alert-secondary" role="alert">Brak legendy spełniającej kryteria wyszukiwania</div>
@endif
                </div>
            </div>
@endsection
