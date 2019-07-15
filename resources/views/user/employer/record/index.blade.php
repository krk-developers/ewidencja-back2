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
                                        <th scope="col">Nazwisko</th>
                                        <th scope="col">PESEL</th>
                                        <th scope="col">Nieobecności</th>
                                        <th scope="col">Przepracowane dni</th>
                                        <th scope="col">Przepracowane godziny</th>
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
                                        <td>{{ $worker->lastname }}</td>
                                        <td>{{ $worker->pesel }}</td>
                                        <td>{{ $worker->absence_days }}</td>
                                        <td>{{ $worker->worked_days }}</td>
                                        <td>{{ $worker->worked_hours }}</td>
                                        <td>
@if ($worker->worker_events->count() > 0)
                                            <table class="table table-bordered record text-muted inner-table">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">L.P.</th>
                                                        <th scope="col">#</th>
                                                        <th scope="col">Nazwa</th>
                                                        <th scope="col">Początek</th>
                                                        <th scope="col">Koniec</th>
                                                        <th scope="col">Legenda</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
@foreach ($worker->worker_events as $event)
                                                    <tr>
                                                        <th scope="row">{{ $loop->iteration }}</th>
                                                        <td>{{ $event->id }}</td>
                                                        <td>{{ $event->title }}</td>
                                                        <td>{{ $event->start }}</td>
                                                        <td>{{ $event->end }}</td>
                                                        <td>
                                                            <span data-toggle="tooltip" data-placement="top" title="{{ $event->legend_display_name }}">
                                                                {{ $event->legend_name }}
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
                                        <th scope="row">Dni w miesiącu</th>
                                        <td>{{ $days_in_month }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            Dni pracujących
                                            <small class="text-secondary">po odliczeniu sobót, niedziel i dni wolnych od pracy</small>
                                        </th>
                                        <td>{{ $working_days }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Dni ustawowo wolnych od pracy</th>
                                        <td>{{ $public_holidays_count }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            Suma przepracowanych dni
                                        </th>
                                        <td>{{ $total_worked_days }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            Suma przepracowanych godzin
                                        </th>
                                        <td>{{ $total_worked_hours }}</td>
                                    </tr>
@if ($public_holidays_count > 0)
                                    <tr>
                                        <th scope="row">Dni ustawowo wolne od pracy</th>
                                        <td>
                                            <table class="table-borderless table-sm holiday text-secondary">
                                                <tbody>
@foreach ($public_holidays as $holiday)
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
                                    <a href="{{ route('employers.records.print', [$employer, $year_month]) }}" title="Wersja do druku" class="btn btn-primary">
                                        <i class="fas fa-print"></i> Druk
                                    </a>
                                    <a href="{{ route('employers.records.pdf', [$employer, $year_month]) }}" title="PDF" class="btn btn-primary">
                                        <i class="fas fa-file-pdf"></i> PDF
                                    </a>
                                    <a href="{{ route('employers.records.excel', [$employer, $year_month]) }}" title="Eksport do Excel" class="btn btn-primary">
                                        <i class="fas fa-file-excel"></i> Excel
                                    </a>
                                </div>
                            </div>
                        </footer>
                    </div>
                </div>
            </div>
@endsection
