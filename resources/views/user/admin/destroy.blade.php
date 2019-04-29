@extends('layouts.base')

@section('title', 'Usuwanie administratora:' . $admin->user->name . ' ' .$admin->lastname)

@section('content')
            <div class="row mt-5">
                <div class="col-sm">
                    <div class="card">
                        <div class="card-header">
                            <i class="fas fa-eraser"></i> Czy usunąć administratora {{ $admin->user->name}} {{ $admin->lastname }}?
                        </div>
                        <div class="card-body">
                            <p class="card-text">
                                Operacja bezpowrotna
                            </p>
                        </div>
                        <footer class="card-footer bg-white">
                            <form action="{{ route('admins.destroy', $admin->id) }}" method="POST">
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
