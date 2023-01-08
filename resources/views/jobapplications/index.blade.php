@extends('layouts.base')

@section('content')

    <div class="card">

        <div class="card-title card-header">
            <strong>
                Álláshirdetések:
            </strong>
        </div>

        <div class="card-body">

            @unless($jobadvertisements->isEmpty())
                <table class="table">
                    <thead>
                        <th>Sorszám</th>
                        <th>Állás</th>
                        <th>Műveletek</th>
                    </thead>
                    <tbody>
                        @foreach ($jobadvertisements as $index => $jobadvertisement)
                            <tr>
                                <td>
                                    {{ $index + 1 }}.
                                </td>
                                <td>
                                    Munkakör: {{ $jobadvertisement->title }} <br>
                                    Munkavégzés helye: {{ $jobadvertisement->location }}
                                </td>
                                <td class="d-flex gap-3">
                                    <a href="/jobapplications/{{ $jobadvertisement->jobapplication->id }}"
                                        class="btn btn-primary mb-3"> <i class="bi bi-info-circle"></i>
                                        Részletek...</a>
                                    <a href="/jobadvertisements/{{ $jobadvertisement->id }}/edit" class="btn btn-warning mb-3"> <i
                                            class="bi bi-pencil-square"></i>
                                        Szerkesztés</a>
                                    <form method="POST" action="/jobadvertisements/{{ $jobadvertisement->id }}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger"><i class="bi bi-trash"></i> Törlés</button>
                                    </form>
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
