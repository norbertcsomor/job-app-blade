@extends('layouts.base')

@section('content')

    <div class="card">

        <div class="card-header card-title">
            <strong>
                Jelentkezések:
            </strong>
        </div>

        <div class="card-body">

            @unless($jobapplications->isEmpty())
                <table class="table table-striped">
                    <thead>
                        <th>Munkakör/Helyszín</th>
                        <th>Önéletrajz</th>
                        <th>Állapot</th>
                        <th>Műveletek</th>
                    </thead>
                    <tbody>
                        @foreach ($jobapplications as $index => $jobapplication)
                            <tr>
                                <td>
                                    Munkakör: {{ $jobapplication->jobadvertisement->title }} <br>
                                    Helyszín: {{ $jobapplication->jobadvertisement->location }}
                                </td>
                                <td>
                                    <a href="/cvs/{{ $jobapplication->cv->id }}">{{ $jobapplication->cv->title }}</a>
                                </td>
                                <td>
                                    {{ $jobapplication->status }}  
                                </td>
                                <td class="d-flex gap-3">
                                    <a href="/jobadvertisements/{{ $jobapplication->jobadvertisement->id }}"
                                        class="btn btn-primary">
                                        <i class="bi bi-info-circle-fill"></i>
                                        Részletek... </a>
                                    <form method="POST" action="/jobapplications/{{ $jobapplication->id }}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger"><i class="bi bi-trash"></i> Visszalépés</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-center mb-3">Nincsenek jelentkezések.</p>
            @endunless
        </div>
    </div>
@endsection
