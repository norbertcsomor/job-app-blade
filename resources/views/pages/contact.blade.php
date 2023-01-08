@extends('layouts.base')

@section('content')
    <div class="card">
        <div class="card-header card-title">
            <strong>Kapcsolat:</strong>
        </div>

        <div class="card-body">

            <div class="text-center">
                <strong>
                    Üzenet küldése
                </strong>
            </div>

            <form method="POST" action="/contact">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email-cím:</label>
                    <input type="email" class="form-control" name="email" value="{{ old('email') }}" />

                    @error('email')
                        <p class="text-danger">Az email-címet meg kell adni.</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Név:</label>
                    <input type="text" class="form-control" name="name" value="{{ old('name') }}" />

                    @error('name')
                        <p class="text-danger">A nevet meg kell adni.</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="subject" class="form-label">Tárgy:</label>
                    <input type="text" class="form-control" name="subject" value="{{ old('subject') }}" />

                    @error('subject')
                        <p class="text-danger">A tárgyat meg kell adni.</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="message" class="form-label">Üzenet:</label>
                    <textarea class="form-control" name="message" value="{{ old('message') }}">
                    </textarea>

                    @error('message')
                        <p class="text-danger">Az üzenetet meg kell adni.</p>
                    @enderror
                </div>

                <div class="checkbox text-justify mb-3">
                    <input type="checkbox" name="accept1" value="{{ old('accept1') }}">
                    Az adatkezelési tájékoztatót, az
                    ÁSZF, a Szolgáltató
                    jognyilatkozatát megismertem és elfogadtam, illetve hozzájárulok az adataim kezeléséhez a
                    tájékoztatóban foglaltak szerint.
                    @error('accept1')
                        <p class="text-danger">A tájékoztatót el kell fogadnia.</p>
                    @enderror
                </div>

                <div class="checkbox text-justify mb-3">
                    <input type="checkbox" name="accept2" value="{{ old('accept2') }}">
                    Elfogadom az állásoldalra vonatkozó egyéb szabályokat, szabályozást.
                    @error('accept2')
                        <p class="text-danger">A szabályokat el kell fogadnia.</p>
                    @enderror
                </div>

                <div class="text-center">
                    <button class="btn btn-primary">
                        Küldés
                    </button>
                </div>
            </form>
        </div>
    </div>
    </div>
@endsection
