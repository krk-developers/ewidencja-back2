@extends('layouts.base')

@section('title', 'Super Administrator')

@section('content')
            <div class="row mt-5">
                <div class="col-sm">
                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-user-shield"></i> Super Administrator
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th scope="row">Imię</th>
                                        <td>{{ $superadmin->user->name }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Nazwisko</th>
                                        <td>{{ $superadmin->lastname }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">E-mail</th>
                                        <td>
                                            <a href="mailto:{{ $superadmin->email }}" title="Wysyła e-mail">
                                                <i class="fas fa-paper-plane"></i> {{ $superadmin->user->email }}
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Uprawnienia</th>
                                        <td>{{ $superadmin->user->type->display_name }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Opis</th>
                                        <td>{{ $superadmin->user->type->description }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <footer class="card-footer bg-white">
                            <form action="{{ route('superadmins.destroy', $superadmin->id) }}" method="POST">
                                @csrf

                                @method('DELETE')

                                <a href="{{ route('superadmins.index') }}" title="Powrót do poprzedniej strony" class="btn btn-light">
                                    <i class="fas fa-angle-left"></i> Powrót
                                </a>
@can('update', $superadmin)
                                <a href="{{ route('superadmins.edit', $superadmin->id) }}" title="Edycja" class="btn btn-primary">
                                    <i class="fas fa-user-edit"></i> Edytuj
                                </a>
@endcan
@can('delete', $superadmin)
                                <button type="submit" class="btn btn-danger" title="Usuwa administratora">
                                    <i class="fas fa-eraser"></i> Usuń
                                </button>
@endcan
                            </form>
                        </footer>
                    </div>
                </div>
            </div>
@endsection
