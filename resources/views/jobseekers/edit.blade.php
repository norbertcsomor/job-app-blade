@extends('layouts.base')

@section('content')
    @php
        Session::put('cv_url', URL::full());
    @endphp

    <div class="card">
        <div class="card-header card-title">
            <strong>Álláskereső szerkesztése:</strong>
        </div>

        <div class="card-body">

            <form method="POST" action="/jobseekers/{{ $jobseeker->id }}">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label">Név:</label>
                    <input type="text" class="form-control" name="name" value="{{ $jobseeker->name }}" />

                    @error('name')
                        <p class="text-danger">A nevet meg kell adni.</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">Cím:</label>
                    <input type="text" class="form-control" name="address" value="{{ $jobseeker->address }}" />

                    @error('address')
                        <p class="text-danger">A címet meg kell adni.</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="telephone" class="form-label">
                        Telefonszám:
                    </label>
                    <input type="text" class="form-control" name="telephone" value="{{ $jobseeker->telephone }}" />

                    @error('telephone')
                        <p class="text-danger">A telefonszámot meg kell adni.</p>
                    @enderror
                </div>

                <div class="text-center">
                    <button class="btn btn-warning mb-3"><i class="bi bi-pencil-fill"></i>
                        Álláskereső szerkesztése
                    </button>
                </div>
            </form>

            <div class="text-center">
                <form method="POST" action="/jobseekers/{{ $jobseeker->id }}">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger"><i class="bi bi-trash"></i> Álláskereső törlése</button>
                </form>
            </div>

            <hr>

            <div class="text-center">
                <strong>Önéletrajzok</strong>
            </div>

            <p class="text-center">
                Itt tud önéletrajzot csatolni a profiljához. <br />
                (A maximális file-méret 5 MB. Az elfogadott formátum: PDF)
            </p>

            <hr>

            <div class="text-center mb-3">
                <strong>
                    Új önéletrajz feltöltése:
                </strong>
            </div>

            <form method="POST" action="/cvs" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="title" class="form-label">
                        <strong>
                            Önéletrajz elnevezése:
                        </strong>
                    </label>
                    <input type="text" class="form-control" name="title" value="{{ old('title') }}" />

                    @error('title')
                        <p class="text-danger">Az önéletrajz elnevezését meg kell adni.</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="path" class="form-label">
                        <strong>
                            Önéletrajz kiválasztása:
                        </strong>
                    </label>
                    <input type="file" accept=".pdf" class="form-control" name="path" />

                    @error('path')
                        <p class="text-danger">Az önéletrajzot ki kell választani.</p>
                    @enderror
                </div>

                <div class="text-center">
                    <button class="btn btn-success" type="submit">
                        <i class="bi bi-file-earmark-plus-fill"></i>
                        Önéletrajz feltöltése
                    </button>
                </div>
            </form>

            <hr>

            <div class="mb-3">
                <strong>
                    Feltöltött önéletrajzok kezelése:
                </strong>
            </div>

            @unless($cvs->isEmpty())
                @foreach ($cvs as $index => $cv)
                    <div class="d-flex gap-3">
                        <a href="/cvs/{{ $cv->id }}">{{ $cv->title }}</a>
                        <form method="POST" action="/cvs/{{ $cv->id }}">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger"><i class="bi bi-trash"></i></button>
                        </form>
                    </div>
                @endforeach
            @else
                <p class="text-center">Nincsenek önéletrajzok.</p>
            @endunless
        </div>
    </div>
@endsection
