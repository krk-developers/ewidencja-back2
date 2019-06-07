@extends('layouts.base')

@section('title', 'Dodawanie pracownika do pracodawcy: ' . $employer->company)

@section('content')
            <div class="row mt-5">
                <div class="col-sm">
                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-user-plus"></i>
                            Dodawanie pracownika do pracodawcy: {{ $employer->company }}
                        </div>
                        <div class="card-body">
                                <form action="{{ route('employers.workers.store', $employer->id) }}" method="POST">
                                    @csrf

                                    <input type="hidden" name="admin" value="{{ $admin->id }}">
                                    <div class="form-group row">
                                        <label for="worker_id" class="col-sm-2 col-form-label">Pracownik</label>
                                        <div class="col-sm-10">
                                            <select id="worker_id" name="worker_id" class="form-control">
@forelse ($workers as $worker)
                                                <option value="{{ $worker->id }}" title="{{ $worker->pesel }}">
                                                    {{ $worker->user->name }} {{ $worker->lastname }}
                                                </option>
@endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="contract_from" class="col-sm-2 col-form-label" data-toggle="tooltip" data-placement="top" title="Umowa o pracę">Umowa od</label>
                                        <div class="col-sm-10">
                                            <input type="date" id="contract_from" name="contract_from" class="form-control{{ $errors->has('contract_from') ? ' is-invalid' : '' }}" value="{{ old('contract_from') }}" placeholder="Początkowa data umowy o pracę" required>
@if ($errors->has('contract_from'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('contract_from') }}</strong>
                                            </span>
@else
                                            <small id="contract_from_help" class="form-text text-muted">Pole obowiązkowe</small>
@endif
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="contract_to" class="col-sm-2 col-form-label" data-toggle="tooltip" data-placement="top" title="Umowa o pracę">Umowa do</label>
                                        <div class="col-sm-10">
                                            <input type="date" id="contract_to" name="contract_to" class="form-control{{ $errors->has('contract_to') ? ' is-invalid' : '' }}" value="{{ old('contract_to') }}" placeholder="Końcowa data umowy o pracę">
@if ($errors->has('contract_to'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('contract_to') }}</strong>
                                            </span>
@else
                                            <small id="contract_to_help" class="form-text text-muted">Pole obowiązkowe</small>
@endif
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="indefinite" class="col-sm-2 col-form-label" data-toggle="tooltip" data-placement="top" title="">Umowa bezterminowa</label>
                                        <div class="col-sm-10">
                                            <input type="checkbox" id="indefinite" name="indefinite" value="true" class="form-check-input">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="part_time" class="col-sm-2 col-form-label">Wymiar etatu</label>
                                        <div class="col-sm-10">
                                            <select id="part_time" name="part_time" class="form-control{{ $errors->has('part_time') ? ' is-invalid' : '' }}" placeholder="Wymiar etatu">
                                                <option value="1">1</option>
                                                <option value="0.75">0.75</option>
                                                <option value="0.5">0.5</option>
                                                <option value="0.25">0.25</option>
                                            </select>
@if ($errors->has('part_time'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('part_time') }}</strong>
                                            </span>
@else
                                            <small id="part_time_help" class="form-text text-muted">Pole obowiązkowe</small>
@endif
                                        </div>
                                    </div>

                                    <a href="{{ route('admins.employers.show', [$admin, $employer]) }}" title="Powrót do poprzedniej strony" class="btn btn-light">
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
@section('js')
        <script src="{{ asset('js/indefinite.js') }}"></script>
@endsection
