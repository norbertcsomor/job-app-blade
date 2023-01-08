@extends('layouts.base')

@section('content')
    @php
    $user = auth()->user();
    @endphp

    <div class="card">
        <div class="card-header card-title">
            <strong>Admin szerkesztése:</strong>
        </div>

        <div class="card-body">

            <form method="POST" action="/jobseekers" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Név:</label>
                    <input type="text" class="form-control" name="name" value="{{ $user->name }}" />

                    @error('name')
                        <p class="text-danger">A nevet meg kell adni.</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">
                        Email-cím:
                    </label>
                    <input type="email" class="form-control" name="email" value="{{ $user->email }}" />

                    @error('email')
                        <p class="text-danger">Az email-címet meg kell adni.</p>
                    @enderror
                </div>

                <hr>

                <div class="mb-3 text-center">
                    <button class="btn btn-warning"><i class="bi bi-gear-fill"></i>
                        Admin szerkesztése
                    </button>
                </div>
            </form>

            <div class="text-center">
                <form method="POST" action="/jobseekers/{{ $user->id }}">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger"><i class="bi bi-trash"></i> Admin törlése</button>
                </form>
            </div>
        </div>
    </div>
@endsection
