@extends('layouts.base')

@section('title', 'Legenda')

@section('content')
            <div class="row mt-5">
                <div class="col-sm">
                    <h3><i class="fas fa-calendar"></i> Legenda</h3>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-sm">
                    <a class="btn btn-success" href="{{ route('legends.create') }}" title="Dodawanie legendy" role="button">
                        <i class="fas fa-calendar-plus"></i> Dodaj
                    </a>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-sm">
@if ($legends->count() > 0)
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">L.P.</th>
                                <th scope="col">#</th>
                                <th scope="col">Skrót</th>
                                <th scope="col">Nazwa</th>
                                <th scope="col">Opis</th>
                                <th scope="col">Dzień roboczy</th>
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
                                <td class="description">{{ $legend->description }}</td>
                                <td class="description">@if($legend->working_day == 1)Tak @endif @if($legend->working_day == 0)Nie @endif</td>
                            </tr>
@endforeach
                        </tbody>
                    </table>
@else
                    <div class="alert alert-secondary" role="alert">Brak legendy</div>
@endif
                </div>
            </div>
@endsection
