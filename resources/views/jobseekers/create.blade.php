@extends('layouts.base')

@section('content')
    <div class="card">
        <div class="card-header card-title">
            <strong>Álláskereső létrehozása:</strong>
        </div>

        <div class="card-body">

            <form method="POST" action="/jobseekers">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Név:</label>
                    <input type="text" class="form-control" name="name" value="{{ old('name') }}" />

                    @error('name')
                        <p class="text-danger">A nevet meg kell adni.</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">Cím:</label>
                    <input type="text" class="form-control" name="address" value="{{ old('address') }}" />

                    @error('address')
                        <p class="text-danger">A címet meg kell adni.</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="telephone" class="form-label">
                        Telefonszám:
                    </label>
                    <input type="text" class="form-control" name="telephone" value="{{ old('telephone') }}" />

                    @error('email')
                        <p class="text-danger">A telefonszámot meg kell adni.</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">
                        Email-cím:
                    </label>
                    <input type="text" class="form-control" name="email" value="{{ old('email') }}" />

                    @error('email')
                        <p class="text-danger">Az email-címet meg kell adni.</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">
                        Jelszó: (A minimális hossz: 10 karakter.)
                    </label>
                    <input type="text" class="form-control" name="password" value="{{ old('password') }}" />

                    @error('password')
                        <p class="text-danger">A jelszót meg kell adni.</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">
                        Jelszó megerősítése:
                    </label>
                    <input type="text" class="form-control" name="password_confirmation"
                        value="{{ old('password_confirmation') }}" />

                    @error('password_confirmation')
                        <p class="text-danger">A jelszavak nem egyeznek meg.</p>
                    @enderror
                </div>

                <hr>

                <div class="text-center">
                    <strong>Adatvédelem</strong>
                </div>

                <div class="checkbox text-justify mb-3">
                    <input type="checkbox" name="accept1">
                    A jelentkezéssel elfogadom az <a href="/blabla">Adatkezelési tájékoztató</a> álláspályázók számára
                    dokumentumban foglaltakat. <br> Jogosult vagyok a jelentkezésemet és a regisztrációmat bármikor
                    törölni.
                    @error('accept1')
                        <p class="text-danger">A dokumentumban foglaltakat el kell fogadnia.</p>
                    @enderror
                </div>

                <div class="checkbox text-justify mb-3">
                    <input type="checkbox" name="accept2">
                    Hozzájárulok adataim további 12 hónapig való tárolásához, hogy a jövőben is minden, számomra
                    megfelelő állásajánlatról értesülhessek. Tisztában vagyok vele, hogy nincs semmilyen
                    jogkövetkezménye, ha nem
                    járulok hozzá a személyes adataim további megőrzéséhez.
                    @error('accept2')
                        <p class="text-danger">A hozzájárulást el kell fogadnia.</p>
                    @enderror
                </div>

                <p>
                    Jelentkezésének elküldésével igazolja adatainak helyességét.
                </p>

                <div class="text-center">
                    <button class="btn btn-success mb-3">
                        Álláskereső létrehozása
                    </button>
                </div>

                <div class="text-center">
                    <p>
                        Van már felhasználói fiókja? <br>
                        <a href="/login" class="btn btn-primary mt-3">Jelentkezzen be!</a>
                    </p>
                </div>
            </form>
        </div>
    </div>
@endsection
