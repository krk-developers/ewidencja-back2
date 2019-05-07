@extends('layouts.base')

@section('title', 'Ewidencja dla ' . $worker->user->name . ' ' .$worker->lastname)

@section('content')
            <div class="row mt-5">
                <div class="col-sm">
                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-user"></i>
                            Ewidencja dla pracownika {{ $worker->user->name }} {{ $worker->lastname }} PESEL: {{ $worker->pesel }}
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <tbody>
@if ($is_future)
                                    <tr class="bg-danger text-center text-white">
                                        <th scope="row" colspan=2>Jesteś w przyszłości</th>
                                    </tr>
@endif
                                    <tr>
                                        <th scope="row">Okres</th>
                                        <td>{{ $start }} &mdash; {{ $end }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Okres słownie</th>
                                        <td>{{ $month_name }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Liczba dni w miesiącu</th>
                                        <td>{{ $days_in_month }}</td>
                                    </tr>
                                    {{--
                                    <tr>
                                        <th scope="row">
                                            Liczba dni pracujących
                                            <small class="text-secondary">po odliczeniu sobót i niedziel<small>
                                        </th>
                                        <td>{{ $time_period_weekend_filter }}</td>
                                    </tr>
                                    --}}
                                    <tr>
                                        <th scope="row">
                                            Liczba dni pracujących
                                            <small class="text-secondary">po odliczeniu sobót, niedziel i dni wolnych od pracy<small>
                                        </th>
                                        <td>{{ $time_period_public_holiday_filter }}</td>
                                    </tr>
@if ($public_holidays_in_month->count() > 0)
                                    <tr>
                                        <th scope="row">Dni ustawowo wolne od pracy</th>
                                        <td>
                                            <table class="table-borderless table-sm holiday text-secondary">
                                                <tbody>
@foreach ($public_holidays_in_month as $holiday)
                                                    <tr>
                                                        <td>{{ $holiday->title }}</td>
                                                        <td>{{ $holiday->start }}</td>
                                                    </tr>
@endforeach
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
@endif
                                    <tr>
                                        <th scope="row">Liczba dni ustawowo wolnych od pracy</th>
                                        <td>{{ $public_holidays_in_month->count() }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Liczba nieobecności</th>
                                        <td>{{ $absence_in_days }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Liczba dni przepracowanych</th>
                                        <td>{{ $working_days }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <footer class="card-footer bg-white">
                            <div class="row mt-3">
                                <div class="col-sm">
                                    <a href="{{ route('workers.records.index', [$worker->id, $previous_month]) }}" title="{{ $previous_month }}" class="btn btn-outline-secondary btn-block" role="button">Poprzedni miesięc</a>
                                </div>
                                <div class="col-sm">
                                    <a href="{{ route('workers.records.index', [$worker->id, $next_month]) }}" title="{{ $next_month }}" class="btn btn-outline-secondary btn-block" role="button">Następny miesiąc</a>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-sm">
                            <a href="{{ route('workers.show', $worker->id) }}" title="Powrót do poprzedniej strony" class="btn btn-light">
                                <i class="fas fa-angle-left"></i> Powrót
                            </a>
                            </div>
                            </div>
                        </footer>
                    </div>
                </div>
            </div>
@endsection