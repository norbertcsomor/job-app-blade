@extends('layouts.base')

@section('content')

    <div class="card">

        <div class="card-header card-title">
            <strong>
                Munkaadók:
            </strong>
        </div>

        <div class="card-body">

            @unless($employers->isEmpty())
                <table class="table">
                    <thead>
                        <th>Sorszám</th>
                        <th>Név</th>
                        <th>Email-cím</th>
                        <th>Műveletek</th>
                    </thead>
                    <tbody>
                        @foreach ($employers as $index => $employer)
                            <tr>
                                <td>
                                    {{ $index + 1 }} <br>
                                </td>
                                <td>
                                    {{ $employer->name }}
                                </td>
                                <td>
                                    {{ $employer->email }}
                                </td>
                                <td class="d-flex gap-3">
                                    <a href="/employer/{{ $employer->id }}/edit" class="btn btn-warning">
                                        <i class="bi bi-pencil-square"></i>
                                        Szerkesztés </a>
                                    <form method="POST" action="/employers/{{ $employer->id }}">
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
                <p class="text-center mb-3">Nincsenek munkaadók.</p>
            @endunless
        </div>
    </div>

@endsection
