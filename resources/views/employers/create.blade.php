@extends('layouts.base')

@section('content')
    <div class="card">
        <div class="card-header card-title">
            <strong>Munkaadó létrehozása:</strong>
        </div>

        <div class="card-body">

            <form method="POST" action="/employers">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Cégnév:</label>
                    <input type="text" class="form-control" name="name" value="{{ old('name') }}" />

                    @error('name')
                        <p class="text-danger">A vállalkozás nevét meg kell adni.</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">Cím:</label>
                    <input type="text" class="form-control" name="address" value="{{ old('address') }}" />

                    @error('address')
                        <p class="text-danger">A vállalkozás címét meg kell adni.</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="telephone" class="form-label">
                        Telefonszám:
                    </label>
                    <input type="text" class="form-control" name="telephone" value="{{ old('telephone') }}" />

                    @error('telephone')
                        <p class="text-danger">A vállalkozás telefonszámát meg kell adni.</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">
                        Email-cím:
                    </label>
                    <input type="text" class="form-control" name="email" value="{{ old('email') }}" />

                    @error('email')
                        <p class="text-danger">A vállalkozás email-címét meg kell adni.</p>
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
                    A regisztrációval elfogadom az <a href="*">Adatkezelési tájékoztató</a> munkaadók számára
                    dokumentumban foglaltakat. Jogosult vagyok a jelentkezésemet és a regisztrációmat bármikor
                    törölni.
                    @error('accept1')
                        <p class="text-danger">A dokumentumban foglaltakat el kell fogadnia.</p>
                    @enderror
                </div>

                <div class="checkbox text-justify mb-3">
                    <input type="checkbox"name="accept2">
                    Ezúton hozzájárulok a jelentkezés során megadott adataim feldolgozásához. Tisztában vagyok
                    vele, hogy ezt a hozzájárulást bármikor visszavonhatom.
                    @error('accept2')
                        <p class="text-danger">Az adatok feldolgozását el kell fogadnia.</p>
                    @enderror
                </div>

                <p>
                    Jelentkezésének elküldésével igazolja adatainak helyességét.
                </p>

                <div class="text-center mb-3">
                    <button class="btn btn-success">
                        Munkaadó létrehozása
                    </button>
                </div>

                <div class="text-center">
                    <p>
                        Van már felhasználói fiókja?
                        <a href="/login" class="btn btn-primary">Jelentkezzen be!</a>
                    </p>
                </div>
            </form>
        </div>
    </div>
@endsection
