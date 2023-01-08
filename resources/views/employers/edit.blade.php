@extends('layouts.base')

@section('content')
    <div class="card">
        <div class="card-header card-title">
            <strong>Munkaadó szerkesztése:</strong>
        </div>

        <div class="card-body">

            <form method="POST" action="/employers/{{ $employer->id }}">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label">Cégnév:</label>
                    <input type="text" class="form-control" name="name" value="{{ $employer->name }}" />

                    @error('name')
                        <p class="text-danger">A vállalkozás nevét meg kell adni.</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">Cím:</label>
                    <input type="text" class="form-control" name="address" value="{{ $employer->address }}" />

                    @error('address')
                        <p class="text-danger">A vállalkozás címét meg kell adni.</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="telephone" class="form-label">
                        Telefonszám:
                    </label>
                    <input type="text" class="form-control" name="telephone" value="{{ $employer->telephone }}" />

                    @error('telephone')
                        <p class="text-danger">A vállalkozás telefonszámát meg kell adni.</p>
                    @enderror
                </div>

                <div class="text-center mb-3">
                    <button class="btn btn-warning mb-3" type="submit"> <i class="bi bi-pencil-fill"></i>
                        Munkaadó szerkesztése
                    </button>
            </form>

            <div class="text-center">
                <form method="POST" action="/employers/{{ $employer->id }}">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger"><i class="bi bi-trash"></i> Munkaadó törlése</button>
                </form>
            </div>
        </div>
    </div>
@endsection
