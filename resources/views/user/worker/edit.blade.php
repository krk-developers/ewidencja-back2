@extends('layouts.base')

@section('title', $worker->user->name . ' ' .$worker->lastname)

@section('content')
            <div class="row mt-5">
                <div class="col-sm">
                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-user-edit"></i> Edycja pracownika
                        </div>
                        <div class="card-body">
                            <p class="card-text">
                                <form action="{{ route('workers.update', $worker->id) }}" method="POST">
                                    @method('PUT')

                                    @csrf

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email address</label>
                                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Password</label>
                                        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                                    </div>
                                    <div class="form-group form-check">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                        <label class="form-check-label" for="exampleCheck1">Check me out</label>
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
