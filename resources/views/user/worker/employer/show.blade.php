@extends('layouts.base')

@section('title', 'Karta')

@section('content')
            <div class="row mt-5">
                <div class="col-sm">
                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-user"></i> Pracownik
                            {{ $worker->user->name }} {{ $worker->lastname }}
                            zatrudniony w 
                            {{ $employer->company }}
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th scope="row">Umowa od</th>
                                        <td>{{ $employer_information->pivot->contract_from }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Umowa do</th>
                                        <td>@if( $employer_information->pivot->contract_to == null) <span class="text-success">Umowa bezterminowa</span> @else {{ $employer_information->pivot->contract_to }} @endif</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Wymiar etatu</th>
                                        <td>{{ $employer_information->pivot->part_time }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <footer class="card-footer bg-white">
                            <a href="{{ URL::previous() }}" title="Powrót do poprzedniej strony" class="btn btn-light">
                                <i class="fas fa-angle-left"></i>
                                Powrót
                            </a>
                        </footer>
                    </div>
                </div>
            </div>
@endsection
