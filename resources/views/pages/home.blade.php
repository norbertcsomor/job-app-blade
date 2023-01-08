@extends('layouts.base')

@section('content')
    @include('partials._search')
    @if (!Auth::check())
        @include('partials._hero')
    @endif

    <div class="card">

        <div class="card-header card-title mb-3">
            <strong>
                Álláshirdetéseink:
            </strong>
        </div>

        <div class="card-body">
            @include('jobadvertisements.index')
        </div>
    </div>

    <div class="text-center">
        {{ $jobadvertisements->links() }}
    </div>
@endsection
