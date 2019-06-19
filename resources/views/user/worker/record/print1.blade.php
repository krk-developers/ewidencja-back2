<!doctype html>
<html lang="pl">
    <head>
        <meta charset="utf-8">    
        <link rel="stylesheet" href="">
        <title>{{ $worker->user->name }} {{ $worker->lastname }}. {{ $employer->company }}. {{ $yearMonth }}</title>
        <link href="https://fonts.googleapis.com/css?family=Anonymous+Pro&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=PT+Mono&display=swap" rel="stylesheet">
        <style>
            body { background-color: #FFFFFF; color: #000000; margin: 0; padding: 0; font-family: 'PT Mono', 'Anonymous Pro', monospace; font-size: 12pt; }

            table { width: 100%; }
            table tbody tr td { border-top: 1px solid #797979; border-bottom: 2px solid #797979; padding-top: 4pt; padding-bottom: 4pt; }

            table.header, table.main, table.calendar, div.sign { margin-bottom: 35pt; }
            table.header {}
            table.header tr td {}

            table.event thead tr th { text-align: left; border-top: 2px solid #797979; border-bottom: 1px solid #797979; padding-top: 4pt; padding-bottom: 4pt; }
            table.event caption { font-size: 14pt; font-weight: bold; }
            table.event tbody tr td { border-top: 0; border-bottom: 1px solid #797979; }

            table.calendar tbody tr td { text-align: center; }

            div.sign { text-align: center; float: left; width: 23%; border-top: 1px dotted #797979; padding-top: 0.5em; margin-left: 5%; margin-right: 5%; }
            div.sign { margin-top: 30pt; }

            div.legend { float: left; width: 50%; }
            div.legend table { font-size: 10pt; color: #444444; }
            div.legend table.left { padding-right: 1%; }
            div.legend table.right { padding-left: 1%; }
            div.legend table tbody tr td { border-bottom: 0; border-top: 1px dashed #797979; }
        </style>
    </head>
    <body>
        <table class="header">
            <tbody>
                <tr>
                    <td>{{ $worker->user->name }} {{ $worker->lastname }}</td>
                    <td>PESEL: {{ $worker->pesel }}</td>
                    <td>Pracodawca: {{ $employer->company }}</td>
                    <td>Okres: {{ $yearMonth }}</td>
                    <td>Kwota ekwiwalentu: {{ $worker->equivalent_amount }}</td>
                    <td>Etat: {{ $worker->effective }}</td>
                </tr>
            </tbody>
        </table>

        <table class="main">
            <tbody>
                <tr>
                    <td>Liczba dni w miesiącu: {{ $days_in_month }}</td>
                    <td>Liczba dni pracujących: {{ $time_period_public_holiday_filter }}</td>
                    <td>Liczba dni ustawowo wolnych od pracy: {{ $public_holidays_in_month->count() }}</td>
                    <td>Liczba nieobecności: {{ $absence_in_days }}</td>                    
                    <td>Liczba dni przepracowanych: {{ $working_days }}</td>
                </tr>
            </tbody>
        </table>

        <table class="calendar">
            <tbody>
                <tr>
@foreach ($calendar as $key => $value)
                    <td>
                        {{ $key }}<br>{{ $value }}
                    </td>
@endforeach
                </tr>
            </tbody>
        </table>

{{--
        <table class="event">
            <caption>Nieobecności</caption>
            <thead>
                <tr>
                    <th scope="col">L.P.</th>
                    <th scope="col">Początek</th>
                    <th scope="col">Koniec</th>
                    <th scope="col">Nazwa</th>
                    <th scope="col">Opis</th>
                </tr>
            </thead>
            <tbody>
@foreach ($events as $event)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $event->start }}</td>
                    <td>{{ $event->end }}</td>
                    <td>{{ $event->legend_name }}</td>
                    <td>{{ $event->legend_display_name }}</td>
                </tr>
@endforeach
            </tbody>
        </table>
--}}
        
            <div class="sign">Podpis doradcy zawodowego</div>
            <div class="sign">Podpis pracownika działu kadr</div>
            <div class="sign">Podpis koordynatora</div>
        

        <div class="legend">
            <table class="left">
                <tbody>
@foreach ($legendGroups[0] as $legend)
                    <tr>
                        <td>{{ $legend->name }}:</td>
                        <td>{{ $legend->display_name }}</td>
                    </tr>
@endforeach
                </tbody>
            </table>
        </div>

        <div class="legend">
            <table class="right">
                <tbody>
@foreach ($legendGroups[1] as $legend)
                    <tr>
                        <td>{{ $legend->name }}:</td>
                        <td>{{ $legend->display_name }}</td>
                    </tr>
@endforeach
                </tbody>
            </table>
        </div>
    </body>
</html>