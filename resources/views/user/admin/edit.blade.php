@extends('layouts.base')

@section('title', $admin->user->name . ' ' .$admin->lastname)

@section('content')
            <div class="row mt-5">
                <div class="col-sm">
                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-user-edit"></i> Edycja administratora
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admins.update', $admin->id) }}" method="POST">
                                @method('PUT')

                                @csrf

                                <div class="form-group row">
                                    <label for="name" class="col-sm-2 col-form-label">Imię</label>
                                    <div class="col-sm-10">
                                        <input type="text" id="name" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ $admin->user->name }}" placeholder="np. Jan" autofocus> <!-- required -->
@if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
@else
                                        <small id="name_help" class="form-text text-muted">Pole obowiązkowe</small>
@endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="lastname" class="col-sm-2 col-form-label">Nazwisko</label>
                                    <div class="col-sm-10">
                                        <input type="text" id="lastname" name="lastname" class="form-control{{ $errors->has('lastname') ? ' is-invalid' : '' }}" value="{{ $admin->lastname }}" placeholder="np. Kowalski"> <!-- required -->
@if ($errors->has('lastname'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('lastname') }}</strong>
                                        </span>
@else
                                        <small id="lastname_help" class="form-text text-muted">Pole nieobowiązkowe</small>
@endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="email" class="col-sm-2 col-form-label">E-mail</label>
                                    <div class="col-sm-10">
                                        <input type="email" id="email" name="email" class="form-control" value="{{ $admin->user->email }}" readonly>
                                        <small id="email_help" class="form-text text-muted">Pola nie można edytować</small>
                                    </div>
                                </div>
                                
                                <a href="{{ route('admins.show', $admin->id) }}" title="Powrót do poprzedniej strony" class="btn btn-light">
                                    <i class="fas fa-angle-left"></i> Powrót
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Zapisz
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
@endsection
