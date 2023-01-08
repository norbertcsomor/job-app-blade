@extends('layouts.base')

@section('content')

<div class="card">

    <div class="card-header card-title">
        <strong>
            Álláskeresők:
        </strong>
    </div>

    <div class="card-body">

        @unless($jobseekers->isEmpty())
            <table class="table">
                <thead>
                    <th>Sorszám</th>
                    <th>Név</th>
                    <th>Email-cím</th>
                    <th>Műveletek</th>
                </thead>
                <tbody>
                    @foreach ($jobseekers as $index => $jobseeker)
                        <tr>
                            <td>
                                {{ $index + 1 }} <br>
                            </td>
                            <td>
                                {{ $jobseeker->name }}
                            </td>
                            <td>
                                {{ $jobseeker->email }}
                            </td>
                            <td class="d-flex gap-3">
                                <a href="/jobseeker/{{ $jobseeker->id }}/edit"
                                    class="btn btn-warning">
                                    <i class="bi bi-gear-fill"></i>
                                    Szerkesztés </a>
                                <form method="POST" action="/jobseekers/{{ $jobseeker->id }}">
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
            <p class="text-center mb-3">Nincsenek álláskeresők.</p>
        @endunless
    </div>
</div>

@endsection
