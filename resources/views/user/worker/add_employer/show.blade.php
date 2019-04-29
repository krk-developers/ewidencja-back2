@extends('layouts.base')

@section('title', 'Dodawanie pracodawcy dla pracownika: ' . $worker->user->name . ' ' .$worker->lastname)

@section('content')
            <div class="row mt-5">
                <div class="col-sm">
                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-user-edit"></i>
                            Dodawanie pracodawcy dla pracownika: {{ $worker->user->name }} {{ $worker->lastname}}
                        </div>
                        <div class="card-body">
                            <p class="card-text">
                                <form action="{{ route('workers.employers.store', $worker->id) }}" method="POST">
                                    @csrf

                                    <div class="form-group row">
                                        <label for="employer_id" class="col-sm-2 col-form-label">Pracodawca</label>
                                        <div class="col-sm-10">
                                            <select id="employer_id" name="employer_id" class="form-control">
@forelse ($employers as $employer)
                                                <option value="{{ $employer->id }}">{{ $employer->company }}</option>
@endforeach
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <a href="{{ route('workers.show', $worker->id) }}" title="Powrót do poprzedniej strony" class="btn btn-light">
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
