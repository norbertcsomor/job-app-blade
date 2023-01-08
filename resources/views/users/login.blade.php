@extends('layouts.base')

@section('content')
    <script>
        function showPassword() {
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>

    <div class="card">
        <div class="card-header card-title text-center">
            <strong>Bejelentkezés</strong>
        </div>
        <div class="card-body">
            <form method="POST" action="/authenticate">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email-cím: </label>
                    <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                    @error('email')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Jelszó: </label>
                    <div class="input-group">
                        <input type="password" id="password" class="form-control" name="password"
                            value="{{ old('password') }}">
                        <button type="button" class="btn btn-light" onclick="showPassword()">
                            <i class="bi bi-eye-fill"></i>
                        </button>
                    </div>
                    @error('password')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class="checkbox text-center mb-3">
                    <input type="checkbox" name="remember_me">
                    <label for="remember_me">Emlékezz rám</label>
                    <br>
                    <a href="/forgetPassword">Elfelejtette a jelszavát?</a>
                </div>
                <div class="text-center">
                    <button class="btn btn-lg btn-dark" type="submit">Bejelentkezés</button>
                </div>
            </form>
        </div>
    </div>
@endsection
