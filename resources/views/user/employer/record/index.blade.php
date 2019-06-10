@extends('layouts.base')

@section('title', 'Ewidencja zbiorcza ' . $month_name)

@section('content')
            <div class="row mt-5">
                <div class="col-sm">
                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-align-justify"></i>
                            Ewidencja zbiorcza. Miesiąc {{ $month_name }}
                        </div>
                        <div class="card-body">
                            <table class="table table-hover mb-5">
                                <thead>
                                    <tr>
                                        <th scope="col">L.P.</th>
                                        <th scope="col">#</th>
                                        <th scope="col">Nazwisko</th>
                                        <th scope="col">PESEL</th>
                                        <th scope="col">Liczba nieobecności</th>
                                        <th scope="col">Liczba dni przepracowanych</th>
                                        <th scope="col">Wydarzenia</th>
                                    </tr>
                                </thead>
                                <tbody>
@if ($is_future)
                                    <tr class="bg-danger text-center text-white">
                                        <th scope="row" colspan="7">Jesteś w przyszłości</th>
                                    </tr>
@endif
@foreach ($workers as $worker)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $worker->id }}</td>
                                        <td>{{ $worker->lastname }}</td>
                                        <td>{{ $worker->pesel }}</td>
                                        <td>{{ $worker->absenceInDays }}</td>
                                        <td>{{ $worker->workingDays }}</td>
                                        <td>
@if ($worker->workerEvents->count() > 0)
                                            <table class="table table-bordered record text-muted inner-table">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">L.P.</th>
                                                        <th scope="col">#</th>
                                                        <th scope="col">Nazwa</th>
                                                        <th scope="col">Początek</th>
                                                        <th scope="col">Koniec</th>
                                                        <th scope="col">Legenda</th>
                                                        <th scope="col">Legenda opis</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
@foreach ($worker->workerEvents as $event)
                                                    <tr>
                                                        <th scope="row">{{ $loop->iteration }}</th>
                                                        <td>{{ $event->id }}</td>
                                                        <td>{{ $event->title }}</td>
                                                        <td>{{ $event->start }}</td>
                                                        <td>{{ $event->end }}</td>
                                                        <td>{{ $event->legend_name }}</td>
                                                        <td>
                                                            <span data-toggle="tooltip" data-placement="top" title="{{ $event->legend_description }}">
                                                                {{ $event->legend_display_name }}
                                                            </span>
                                                        </td>
                                                    </tr>
@endforeach
                                                </tbody>
                                            </table>
@endif
                                        </td>
                                    </tr>
@endforeach
                                <tbody>
                            </table>

                            <hr>

                            <table class="table table-sm period mt-5">
                                <tbody>
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
                                    <tr>
                                        <th scope="row">
                                            Liczba dni pracujących
                                            <small class="text-secondary">po odliczeniu sobót, niedziel i dni wolnych od pracy</small>
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
                                </tbody>
                            </table>
                        </div>
                        <footer class="card-footer bg-white">
                            <div class="row mt-3">
                                <div class="col-sm">
@if ($admin)
                                    <a href="{{ route('employers.records.index', [$employer->id, $previous_month, 'admin' => $admin]) }}" title="{{ $previous_month }}" class="btn btn-outline-secondary btn-block" role="button">
                                        <i class="fas fa-chevron-left"></i> Poprzedni miesięc
                                    </a>
@else
                                    <a href="{{ route('employers.records.index', [$employer->id, $previous_month]) }}" title="{{ $previous_month }}" class="btn btn-outline-secondary btn-block" role="button">
                                        <i class="fas fa-chevron-left"></i> Poprzedni miesięc
                                    </a>
@endif
                                </div>
                                <div class="col-sm">
@if ($admin)
                                    <a href="{{ route('employers.records.index', [$employer->id, $next_month, 'admin' => $admin]) }}" title="{{ $next_month }}" class="btn btn-outline-secondary btn-block" role="button">
                                        Następny miesiąc <i class="fas fa-chevron-right"></i>
                                    </a>
@else
                                    <a href="{{ route('employers.records.index', [$employer->id, $next_month]) }}" title="{{ $next_month }}" class="btn btn-outline-secondary btn-block" role="button">
                                        Następny miesiąc <i class="fas fa-chevron-right"></i>
                                    </a>
@endif
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-sm">
@if ($admin)
                                    <a href="{{ route('admins.employers.show', [$admin, $employer]) }}" title="Powrót do poprzedniej strony" class="btn btn-light">
                                        <i class="fas fa-angle-left"></i> Powrót
                                    </a>
@else
                                    <a href="{{ route('employers.show', $employer) }}" title="Powrót do poprzedniej strony" class="btn btn-light">
                                        <i class="fas fa-angle-left"></i> Powrót
                                    </a>
@endif
                                </div>
                            </div>
                        </footer>
                    </div>
                </div>
            </div>
@endsection
