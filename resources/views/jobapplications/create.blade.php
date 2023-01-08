@extends('layouts.base')
@section('content')

    @php
        Session::put('cv_url', URL::full());
    @endphp

    <div class="card">
        <div class="card-header card-title">
            <strong>
                Állás részletei:
            </strong>
        </div>

        <div class="card-body">

            <h4 class="text-center">{{ $jobadvertisement->title }}</h4>
            <h5 class="text-center">Helyszín: {{ $jobadvertisement->location }}</h5>

            {!! $jobadvertisement->description !!}

            <hr>

            <div class="text-center">
                <strong>Mellékletek</strong>
            </div>

            <p class="text-center">
                Itt tud mellékletet csatolni a regisztrációjához. <br>
                (A maximális file-méret 5 MB. Az elfogadott formátum: PDF)
            </p>

            <div class="mb-3">
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

            <form method="POST" action="/jobapplications" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <strong>
                        Választás a feltöltött önéletrajzok közül:
                    </strong>
                </div>

                @unless($cvs->isEmpty())
                    @foreach ($cvs as $index => $cv)
                        <div class="form-check d-flex gap-3">
                            <input type="radio" class="form-check-input" name="cv_id" value="{{ $cv->id }}">
                            <label class="form-check-label" for="radio">
                                <a href="/cvs/{{ $cv->id }}">{{ $cv->title }}</a>
                            </label>
                        </div>
                    @endforeach
                @else
                    <p class="text-center">Nincsenek önéletrajzok.</p>
                @endunless

                @error('cvId')
                    <p class="text-danger">Az önéletrajzot ki kell választani.</p>
                @enderror

                <hr>

                <input type="hidden" name="jobadvertisement_id" value="{{ $jobadvertisement->id }}">

                <div class="text-center">
                    <button class="btn btn-primary" type="submit"><i class="bi bi-check2"></i>
                        Jelentkezés
                    </button>
                </div>
            </form>
        </div>
    </div>

    @if (session('message'))
        <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <img src="..." class="rounded me-2" alt="...">
                <strong class="me-auto">Üzenet</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                {{ @session('message') }}
            </div>
        </div>
    @endif
@endsection
