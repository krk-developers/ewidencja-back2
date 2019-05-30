@extends('layouts.base')

@section('title', 'Przydzielanie pracodawcy do administratora ' . $admin->user->name . ' ' . $admin->lastname)

@section('content')
            <div class="row mt-5">
                <div class="col-sm">
                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-user-cog"></i>
                            Administrator {{ $admin->user->name }} {{ $admin->lastname }}
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admins.employers.store', $admin->id) }}" method="POST">
                                @csrf

                                <div class="form-group row">
                                    <label for="employer_id" class="col-sm-2 col-form-label">Pracodawca</label>
                                    <div class="col-sm-10">
                                        <select id="employer_id" name="employer_id" class="form-control{{ $errors->has('employer_id') ? ' is-invalid' : '' }}">
@foreach ($employers as $employer)
                                            <option value="{{ $employer->id }}" title="{{ $employer->user->name }}">{{ $employer->company }}</option>
@endforeach
                                        </select>
@if ($errors->has('employer_id'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('employer_id') }}</strong>
                                        </span>
@else
                                        <small id="employer_id_help" class="form-text text-muted">Przypisuje pracodawcę do Aministratora</small>
@endif
                                    </div>
                                </div>
                                <a href="{{ route('admins.employers.index', $admin->id) }}" title="Powrót do poprzedniej strony" class="btn btn-light">
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
