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
                    <div class="alert alert-secondary" role="alert">Brak pracowników</div>
@endif

@if ($employers->count() > 0)
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
                                        {{ $employer->company }}
                                    </a>
                                </td>
                                <td>{{ $employer->nip }}</td>
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
