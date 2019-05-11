@extends('layouts.base')

@section('title', 'Usuwanie pracownika z listy pracowników')

@section('content')
            <div class="row mt-5">
                <div class="col-sm">
                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-eraser"></i> Czy usunąć pracownika {{ $worker->user->name }} {{ $worker->lastname }} z listy pracowników {{ $employer->company }}?
                        </div>
                        <div class="card-body">
                            <p class="card-text">Operacja bezpowrotna</p>
                        </div>
                        <footer class="card-footer bg-white">
                            <form action="{{ route('employers.workers.destroy', [$employer->id, $worker->id]) }}" method="POST">
                                @csrf

                                @method('DELETE')

                                <button type="submit" class="btn btn-secondary" name="delete" value="No"><i class="fas fa-angle-left"></i> Nie</button>
                                <button type="submit" class="btn btn-danger" name="delete" value="Yes"><i class="fas fa-eraser"></i> Tak</button>
                            </form>
                        </footer>
                    </div>
                </div>
            </div>
@endsection