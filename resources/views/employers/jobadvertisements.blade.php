@extends('layouts.base')

@section('content')

    <div class="card">

        @include('jobadvertisements.create')

        <div class="text-center mt-3 mb-3">
            <strong>
                Feladott álláshirdetések
            </strong>
        </div>

        <div class="card-body">

            @unless($jobadvertisements->isEmpty())
                <table class="table">
                    <thead>
                        <th>Sorszám</th>
                        <th>Állás részletei</th>
                        <th>Műveletek</th>
                    </thead>
                    <tbody>
                        @foreach ($jobadvertisements as $index => $jobadvertisement)
                            <tr>
                                <td>
                                    {{ $index + 1 }}
                                </td>
                                <td>
                                    {{ $jobadvertisement->title }} <br>
                                    {{ $jobadvertisement->location }}
                                </td>
                                <td class="d-flex gap-3">
                                    <a href="/jobadvertisements/{{ $jobadvertisement->id }}" class="btn btn-primary mb-3">
                                        <i class="bi bi-info-circle"></i>
                                        Részletek...</a>
                                    <a href="/jobadvertisements/{{ $jobadvertisement->id }}/edit" class="btn btn-warning mb-3">
                                        <i class="bi bi-pencil-square"></i>
                                        Szerkesztés</a>
                                    <button class="btn btn-danger mb-3" data-bs-toggle="modal"
                                        data-bs-target="#deleteJobadvertisementModal">
                                        <i class="bi bi-trash"></i> Törlés</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Álláshirdetés törlése Modal -->
                <div class="modal fade" id="deleteJobadvertisementModal" tabindex="-1"
                    aria-labelledby="deleteJobadvertisementModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="deleteJobadvertisementModalLabel">Álláshirdetés törlése</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Törölni szeretné az álláshirdetést?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Mégsem</button>
                                <form method="POST" action="/jobadvertisements/{{ $jobadvertisement->id }}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger"><i class="bi bi-trash"></i> Törlés</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <p class="text-center">Nincsenek álláshirdetések.</p>
            @endunless

        </div>
    </div>
@endsection
