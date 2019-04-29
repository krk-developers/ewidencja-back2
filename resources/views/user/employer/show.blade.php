@extends('layouts.base')

@section('title', 'Pracodawca')

@section('content')
            <div class="row mt-5">
                <div class="col-sm">
                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-user-tie"></i> Pracodawca
                        </div>
                        <div class="card-body">
                            <p class="card-text">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <th scope="row">Imię</th>
                                            <td>{{ $employer->user->name }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">E-mail</th>
                                            <td>{{ $employer->user->email }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Nazwa firmy</th>
                                            <td><i class="fas fa-industry"></i> {{ $employer->company }}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Pracownicy</th>
                                            <td>
                                                <ul class="list-group list-group-flush">
@forelse ($employer->workers as $worker)
                                                    <li class="list-group-item"><i class="fas fa-industry"></i> {{ $worker->lastname }}</li>
@empty
                                                    <li class="list-group-item text-danger">Brak pracowników</li>
@endforelse
                                                </ul>
                                            </td>
                                        </tr>                                        
                                    </tbody>
                                </table>
                            </p>
                        </div>
                        <footer class="card-footer bg-white">
                            <form action="{{ route('employers.destroy', $employer->id) }}" method="POST">
                                @csrf

                                @method('DELETE')

                                <a href="{{ route('employers.index') }}" title="Powrót do poprzedniej strony" class="btn btn-light">
                                    <i class="fas fa-angle-left"></i> Powrót
                                </a>
                                <a href="{{ route('employers.edit', $employer->id) }}" title="Edycja" class="btn btn-primary">
                                    <i class="fas fa-edit"></i> Edytuj
                                </a>
                                <button type="submit" class="btn btn-danger">
                                    <i class="fas fa-eraser"></i> Usuń
                                </button>
                                <a href="#" title="Dodawanie pracownika" class="btn btn-success">
                                    <i class="fas fa-user-plus"></i> Dodaj pracownika
                                </a>
                            </form>
                        </footer>
                    </div>
                </div>
            </div>
@endsection
