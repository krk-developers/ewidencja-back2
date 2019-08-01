@extends('layouts.base')

@section('title', 'Dni ustawowo wolne od pracy')

@section('content')
@if ($nearest_public_holiday->count() > 0)
            <div class="row mt-5">
                <div class="col-sm">
                    <h2>
                        <small class="text-muted">Pierwszy wolny dzień:</small>
                        {{ $nearest_public_holiday['title'] }}. {{ $nearest_public_holiday['start'] }}
                    </h2>
                </div>
            </div>
@endif
            <div class="row mt-5">
                <div class="col-sm">
                    <h3>
                        <i class="fas fa-bed"></i> Dni ustawowo wolne od pracy
                    </h3>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-sm">
@if ($public_holidays->count() > 0)
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">L.P.</th>
                                <th scope="col">#</th>
                                <th scope="col">Data</th>
                                <th scope="col">Nazwa</th>
                                <th scope="col">Skrót</th>
                            </tr>
                        </thead>
                        <tbody>
@foreach ($public_holidays as $public_holiday)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $public_holiday->id }}</td>
                                <td>{{ $public_holiday->start }}</td>
                                <td>{{ $public_holiday->title }}</td>
                                <td>{{ $public_holiday->legend_name }}</td>
                            </tr>
@endforeach
                        </tbody>
                    </table>
@else
                    <div class="alert alert-secondary" role="alert">Brak rekordów</div>
@endif
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-sm-5">
                    <a href="{{ route('holidays.show', $previousYear) }}" title="{{ $previousYear }}" class="btn btn-outline-secondary btn-block" role="button">
                        <i class="fas fa-chevron-left"></i> Poprzedni rok
                    </a>
                </div>
                
                <div class="col-sm-2">
                    <a href="{{ route('holidays.show', $currentYear) }}" title="{{ $currentYear }}" class="btn btn-outline-secondary btn-block" role="button">
                        <i class="fas fa-dot-circle"></i> Obecny rok
                    </a>
                </div>
                
                <div class="col-sm-5">
                    <a href="{{ route('holidays.show', $nextYear) }}" title="{{ $nextYear }}" class="btn btn-outline-secondary btn-block" role="button">
                        Następny rok <i class="fas fa-chevron-right"></i>
                    </a>
                </div>
            </div>
@endsection
