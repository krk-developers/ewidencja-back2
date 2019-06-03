@extends('layouts.base')

@section('title', $admin->user->name . ' ' .$admin->lastname)

@section('content')
            <div class="row mt-5">
                <div class="col-sm">
                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-users-cog"></i> Administrator
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th scope="row">Imię</th>
                                        <td>{{ $admin->user->name }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Nazwisko</th>
                                        <td>{{ $admin->lastname }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">E-mail</th>
                                        <td><a href="mailto:{{ $admin->email }}" title="Wysyła e-mail"><i class="fas fa-paper-plane"></i> {{ $admin->user->email }}</a></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            <span data-toggle="tooltip" data-placement="top" title="{{ $admin->user->type->description }}">
                                                Uprawnienia
                                            </span>
                                        </th>
                                        <td>
                                            <span data-toggle="tooltip" data-placement="top" title="{{ $admin->user->type->description }}">
                                                {{ $admin->user->type->display_name }}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Pracodawcy</th>
                                        <td>
                                            <a class="btn btn-outline-secondary" href="{{ route('admins.employers.index', $admin->id) }}" role="button" title="Szczegóły">
                                                <i class="fas fa-industry"></i>
                                                [{{ $admin->employers->count() }}]
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <footer class="card-footer bg-white">
                            <form action="{{ route('admins.destroy', $admin->id) }}" method="POST">
                                @csrf

                                @method('DELETE')

                                <a href="{{ route('admins.index') }}" title="Powrót do poprzedniej strony" class="btn btn-light">
                                    <i class="fas fa-angle-left"></i> Powrót
                                </a>
{{-- @can('update', $admin) --}}
                                <a href="{{ route('admins.edit', $admin->id) }}" title="Edycja" class="btn btn-primary">
                                    <i class="fas fa-user-edit"></i> Edytuj
                                </a>
{{-- @endcan --}}
{{-- @can('delete', $admin) --}}
                                <button type="submit" class="btn btn-danger" title="Usuwa administratora">
                                    <i class="fas fa-eraser"></i> Usuń
                                </button>
{{-- @endcan --}}
                            </form>
                        </footer>
                    </div>
                </div>
            </div>
@endsection
