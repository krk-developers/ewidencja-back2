@extends('layouts.base')

@section('title', $event->title)

@section('content')
            <div class="row mt-5">
                <div class="col-sm">
                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-edit"></i> Edycja wydarzenia
                        </div>
                        <div class="card-body">
                            <form action="{{ route('events.update', $event->id) }}" method="POST">
                                @method('PUT')

                                @csrf

                                <div class="form-group row">
                                    <label for="title" class="col-sm-2 col-form-label">Nazwa</label>
                                    <div class="col-sm-10">
                                        <input type="text" id="title" name="title" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" value="{{ $event->title }}" placeholder="Nazwa wydarzenia"> <!-- required -->
@if ($errors->has('title'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('title') }}</strong>
                                        </span>
@else
                                        <small id="title_help" class="form-text text-muted">Pole nieobowiązkowe</small>
@endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="start" class="col-sm-2 col-form-label">Początek</label>
                                    <div class="col-sm-10">
                                        <input type="date" id="start" name="start" class="form-control{{ $errors->has('start') ? ' is-invalid' : '' }}" value="{{ $event->start }}" placeholder="Początkowa data wydarzenia"> <!-- required -->
@if ($errors->has('start'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('start') }}</strong>
                                        </span>
@else
                                        <small id="start_help" class="form-text text-muted">Pole obowiązkowe</small>
@endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="end" class="col-sm-2 col-form-label">Koniec</label>
                                    <div class="col-sm-10">
                                        <input type="date" id="end" name="end" class="form-control{{ $errors->has('end') ? ' is-invalid' : '' }}" value="{{ $event->end }}" placeholder="Końcowa data wydarzenia">
@if ($errors->has('end'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('end') }}</strong>
                                        </span>
@else
                                        <small id="end_help" class="form-text text-muted">Pole nieobowiązkowe</small>
@endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="legend_id" class="col-sm-2 col-form-label">Legenda</label>
                                    <div class="col-sm-10">
                                        <select id="legend_id" name="legend_id" class="form-control{{ $errors->has('legend_id') ? ' is-invalid' : '' }}">
@foreach ($legends as $legend)
                                            <option value="{{ $legend->id }}" title="{{ $legend->display_name }}"@if($legend->id == $event->legend->id) selected @endif>{{ $legend->name }}</option>
@endforeach
                                        </select>
@if ($errors->has('legend_id'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('legend_id') }}</strong>
                                        </span>
@else
                                        <small id="legend_id_help" class="form-text text-muted">Pole obowiązkowe</small>
@endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="worker_id" class="col-sm-2 col-form-label">Pracownik</label>
                                    <div class="col-sm-10">
                                        <select id="worker_id" name="worker_id" class="form-control{{ $errors->has('worker_id') ? ' is-invalid' : '' }}">
@foreach ($workers as $worker_)
                                            <option value="{{ $worker_->id }}" title="{{ $worker_->pesel }}"@if($worker_->id == $event->worker->id) selected @endif>{{ $worker_->name }} {{ $worker_->lastname }}</option>
@endforeach
                                        </select>
@if ($errors->has('worker_id'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('worker_id') }}</strong>
                                        </span>
@else
                                        <small id="worker_id_help" class="form-text text-muted">Pole obowiązkowe</small>
@endif
                                    </div>
                                </div>

                                <a href="{{ route('events.show', $event->id) }}" title="Powrót do poprzedniej strony" class="btn btn-light">
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
