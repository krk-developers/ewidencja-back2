<!doctype html>
<html lang="pl">
    <head>
        <meta charset="utf-8">
        <title>Ewidencja indywidualna {{ $worker->user->name }} {{ $worker->lastname }} {{ $employer->company }} {{ $yearMonth }}</title>
        <style>
            body { font-family: DejaVu Sans Mono, DejaVu Sans; font-size: 8pt; margin: 0; padding: 0; }

            table.header, table.main, table.calendar { width: 100%; }

            table.header, table.main {
                margin-bottom: 30pt;
            }

            table.calendar {
                margin-bottom: 50pt;
            }

            table.header tbody tr td, table.main tbody tr td, table.calendar tbody tr td { 
                border-top: 1px solid #777777;
                border-bottom: 2px solid #777777;
                padding-top: 3pt;
                padding-bottom: 3pt;
            }

            div.sign {
                font-size: 7pt;
                border-top: 1px dotted #989898;
                float: left;
                width: 25%;
                padding-top: 3pt;
                margin-bottom: 25pt;
                margin-left: 5%;
                margin-right: 5%;
            }

            table.legend { margin-top: 50pt; }
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
                    <td>Dni w miesiącu: {{ $days_in_month }}</td>
                    <td>Dni pracujących: {{ $working_days }}</td>
                    <td>Dni ustawowo wolnych od pracy: {{ $public_holidays_in_month_count }}</td>
                    <td>Nieobecności: {{ $absence_in_days }}</td>                    
                    <td>Przepracowanych dni: {{ $working_days }}</td>
                    <td>Przepracowanych godzin: {{ $worker_worked_hours }}</td>
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

        <div class="sign">Podpis doradcy zawodowego</div>
        <div class="sign">Podpis pracownika działu kadr</div>
        <div class="sign">Podpis koordynatora</div>

        <table class="legend">
                <tbody>
@foreach ($legend as $legend)
                    <tr>
                        <td>{{ $legend->name }}:</td>
                        <td>{{ $legend->display_name }}</td>
                    </tr>
@endforeach
                </tbody>
        </table>

    </body>
</html>