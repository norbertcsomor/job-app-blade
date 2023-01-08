@extends('layouts.base')

@section('content')

    <div class="card">

        <div class="card-header card-title">
            <strong>
                Álláshirdetések:
            </strong>
        </div>

        <div class="card-body">

            @unless($jobadvertisements->isEmpty())
                <table class="table">
                    <thead>
                        <th>Állás</th>
                        <th>Műveletek</th>
                    </thead>
                    <tbody>
                        @foreach ($jobadvertisements as $index => $jobadvertisement)
                            <tr>
                                <td>
                                    <strong>
                                        Munkakör:
                                    </strong>
                                    {{ $jobadvertisement->title }} <br>
                                    <strong>
                                        Helyszín:
                                    </strong>
                                    {{ $jobadvertisement->location }}
                                </td>
                                <td class="d-flex gap-3">
                                    <a href="/jobadvertisements/{{ $jobadvertisement->id }}" class="btn btn-primary mb-3">
                                        <i class="bi bi-info-circle"></i>
                                        Részletek...</a>
                                    @if (auth()->user() and auth()->user()->role == 'admin')
                                        <a href="/jobadvertisements/{{ $jobadvertisement->id }}/edit"
                                            class="btn btn-warning mb-3"> <i class="bi bi-pencil-square"></i>
                                            Szerkesztés</a>
                                        <form method="POST" action="/jobadvertisements/{{ $jobadvertisement->id }}">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger"><i class="bi bi-trash"></i> Törlés</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-center">Nincsenek álláshirdetések.</p>
            @endunless
        </div>
    </div>
@endsection
