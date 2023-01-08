@extends('layouts.base')

@php
    $user = auth()->user();
@endphp

<script>
    function setStatus(text) {
        document.getElementById("status").value = text;
        document.getElementById("statusForm").submit();
    }
</script>

@section('content')
    <div class="card">
        <div class="card-header card-title">
            <strong>
                Állás részletei:
            </strong>
        </div>

        <div class="card-body">

            <h4 class="text-center">
                <strong>
                    {{ $jobadvertisement->title }}
                </strong>
            </h4>
            <h5 class="text-center">Helyszín: {{ $jobadvertisement->location }}</h5>

            {!! $jobadvertisement->description !!}

            @if ($user->role === 'jobseeker')
                <div class="text-center">
                    <a href="/jobadvertisements/{{ $jobadvertisement->id }}/jobapplications/create" class="btn btn-primary">
                        Jelentkezés
                    </a>
                </div>
            @endif
        </div>
    </div>

    @if ($user->id === $jobadvertisement->user_id)
        <div class="text-center mt-3 mb-3">
            <strong>
                Jelentkezők
            </strong>
        </div>

        @unless($jobapplications->isEmpty())
            <table class="table table-striped">
                <thead>
                    <th>Jelentkező neve/email-címe:</th>
                    <th>Önéletrajz</th>
                    <th>Állapot</th>
                    <th>Műveletek</th>
                </thead>
                <tbody>
                    @foreach ($jobapplications as $index => $jobapplication)
                        <tr>
                            <td>
                                <strong>Név:</strong> {{ $jobapplication->user->name }} <br>
                                <strong>Email:</strong> {{ $jobapplication->user->email }}
                            </td>
                            <td>
                                <a href="/cvs/{{ $jobapplication->cv->id }}">{{ $jobapplication->cv->title }}</a>
                            </td>
                            <td>
                                {{ $jobapplication->status }}
                            </td>
                            <td class="d-flex gap-3">
                                <form name="statusForm" method="POST"
                                    action="/jobapplications/{{ $jobapplication->id }}/status">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" id="status" name="status" value="Nincs megnézve">
                                    <button class="btn btn-success" onclick="setStatus('Elfogadva')"><i
                                            class="bi bi-hand-thumbs-up-fill"></i>
                                        Elfogadás</button>
                                    <button class="btn btn-danger" onclick="setStatus('Elutasítva')"><i
                                            class="bi bi-hand-thumbs-down-fill"></i>
                                        Elutasítás</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="text-center mb-3">Nincsenek jelentkezések.</p>
        @endunless
    @endif
@endsection
