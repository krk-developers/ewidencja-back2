@extends('layouts.base')

@section('title', $legend->name)

@section('content')
            <div class="row mt-5">
                <div class="col-sm">
                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-edit"></i> Edycja legendy
                        </div>
                        <div class="card-body">
                            <form action="{{ route('legends.update', $legend->id) }}" method="POST">
                                @method('PUT')

                                @csrf

                                <div class="form-group row">
                                    <label for="name" class="col-sm-2 col-form-label">Skrót</label>
                                    <div class="col-sm-10">
                                        <input type="text" id="name" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ $legend->name }}" placeholder="Skrót" autofocus> <!-- required -->
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
                                    <label for="display_name" class="col-sm-2 col-form-label">Nazwa</label>
                                    <div class="col-sm-10">
                                        <input type="text" id="display_name" name="display_name" class="form-control{{ $errors->has('display_name') ? ' is-invalid' : '' }}" value="{{ $legend->display_name }}" placeholder="Nazwa legendy"> <!-- required -->
@if ($errors->has('display_name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('display_name') }}</strong>
                                        </span>
@else
                                        <small id="display_name_help" class="form-text text-muted">Pole nieobowiązkowe</small>
@endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="description" class="col-sm-2 col-form-label">Opis</label>
                                    <div class="col-sm-10">
                                        <textarea id="description" name="description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" placeholder="Opis legendy">{{ $legend->description }}</textarea>
@if ($errors->has('description'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('description') }}</strong>
                                        </span>
@else
                                        <small id="description_help" class="form-text text-muted">Pole nieobowiązkowe</small>
@endif
                                    </div>
                                </div>
                                <a href="{{ route('legends.show', $legend->id) }}" title="Powrót do poprzedniej strony" class="btn btn-light">
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
