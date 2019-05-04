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

                                    <div class="form-group row">
                                        <label for="worker_id" class="col-sm-2 col-form-label">Pracownik</label>
                                        <div class="col-sm-10">
                                            <select id="worker_id" name="worker_id" class="form-control">
@forelse ($workers as $worker)
                                                <option value="{{ $worker->id }}" title="{{ $worker->pesel }}">
                                                    {{ $worker->name }} {{ $worker->lastname }}
                                                </option>
@endforeach
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <a href="{{ route('employers.show', $employer->id) }}" title="Powrót do poprzedniej strony" class="btn btn-light">
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
