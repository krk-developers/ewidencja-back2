@extends('layouts.base')

@section('title', $worker->user->name . ' ' .$worker->lastname)

@section('content')
            <div class="row mt-5">
                <div class="col-sm">
                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-user"></i> Pracownik
                        </div>
                        <div class="card-body">
                            <p class="card-text">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <th scope="row">Imię</th>
                                            <td>{{ $worker->user->name }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Nazwisko</th>
                                            <td>{{ $worker->lastname }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Pesel</th>
                                            <td>{{ $worker->pesel }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">E-mail</th>
                                            <td>{{ $worker->user->email }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Pracodawca</th>
                                            <td>
                                                <ul class="list-group list-group-flush">
@forelse ($worker->employers as $employer)
                                                    <li class="list-group-item"><i class="fas fa-industry"></i> {{ $employer->company }}</li>
@empty
                                                    <li class="list-group-item text-danger">Brak zatrudnienia</li>
@endforelse
                                                </ul>
                                            </td>
                                        </tr>                                        
                                    </tbody>
                                </table>
                            </p>
                        </div>
                        <footer class="card-footer bg-white">
                            <form action="{{ route('workers.destroy', $worker->id) }}" method="POST">
                                @csrf

                                @method('DELETE')

                                <a href="{{ route('workers.index') }}" title="Powrót do poprzedniej strony" class="btn btn-light">
                                    <i class="fas fa-angle-left"></i> Powrót
                                </a>
                                <a href="{{ route('workers.edit', $worker->id) }}" title="Edycja" class="btn btn-primary">
                                    <i class="fas fa-user-edit"></i> Edytuj
                                </a>
                                <button type="submit" class="btn btn-danger">
                                    <i class="fas fa-eraser"></i> Usuń
                                </button>
                            </form>
                        </footer>
                    </div>
                </div>
            </div>
@endsection
