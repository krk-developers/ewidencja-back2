@extends('layouts.base')

@section('title', 'Edycja pracodawcy')

@section('content')
            <div class="row mt-5">
                <div class="col-sm">
                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-edit"></i> Edycja pracodawcy
                        </div>
                        <div class="card-body">
                            <p class="card-text">
                                <form action="{{ route('employers.update', $employer->id) }}" method="POST">
                                    @method('PUT')

                                    @csrf

                                    <div class="form-group row">
                                        <label for="name" class="col-sm-2 col-form-label">Imię</label>
                                        <div class="col-sm-10">
                                            <input type="text" id="name" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ $employer->user->name }}" placeholder="np. Jan" autofocus> <!-- required -->
@if ($errors->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
@else
                                            <small id="name-help" class="form-text text-muted">Pole obowiązkowe</small>
@endif
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="company" class="col-sm-2 col-form-label">Nazwa firmy</label>
                                        <div class="col-sm-10">
                                            <input type="text" id="company" name="company" class="form-control{{ $errors->has('company') ? ' is-invalid' : '' }}" value="{{ $employer->company }}" placeholder="np. Jastrząb sp. z o.o.">
@if ($errors->has('company'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('company') }}</strong>
                                            </span>
@else
                                            <small id="company-help" class="form-text text-muted">Pole nieobowiązkowe</small>
@endif
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="email" class="col-sm-2 col-form-label">E-mail</label>
                                        <div class="col-sm-10">
                                            <input type="email" id="email" name="email" class="form-control" value="{{ $employer->user->email }}" readonly>
                                            <small id="email-help" class="form-text text-muted">Pola nie można edytować</small>
                                        </div>
                                    </div>

                                    <a href="{{ route('employers.show', $employer->id) }}" title="Powrót do poprzedniej strony" class="btn btn-light">
                                        <i class="fas fa-angle-left"></i> Powrót
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save"></i> Zapisz
                                    </button>
                                </form>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
@endsection
