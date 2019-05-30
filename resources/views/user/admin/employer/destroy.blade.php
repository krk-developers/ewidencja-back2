@extends('layouts.base')

@section('title', 'Usuwanie pracodawcy z listy: ' . $employer->company)

@section('content')
            <div class="row mt-5">
                <div class="col-sm">
                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-eraser"></i> Czy chcesz usunąć pracodawcę {{ $employer->company }} ze swojej listy?
                        </div>
                        <div class="card-body">
                            <p class="card-text">
                                Operacja bezpowrotna.
                                <span class="text-muted">Usuwa tylko z listy przypisanych pracodawców do administratora</span>
                            </p>
                        </div>
                        <footer class="card-footer bg-white">
                            <form action="{{ route('admins.employers.destroy', [$admin->id, $employer->id]) }}" method="POST">
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