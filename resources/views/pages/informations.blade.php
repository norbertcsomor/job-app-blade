@extends('layouts.base')

@section('content')
    <div class="card">
        <div class="card-header card-title">
            <strong>Információk:</strong>
        </div>
    </div>

    <div class="card-body">

        <span>
            Telefon:
        </span>
        <br>
        <a href="tel:+0000123456">
            +00 00 123 456
        </a>
        <br>
        <span>
            E-mail:
        </span>
        <br>
        <a href="mailto:xy@gmail.com">
            xy@gmail.com
        </a>
        <br>
        <span>
            Cím:
        </span>
        <br>
        <a>
            Város 0000 Xy út 00.
        </a>
        <br>
    </div>
@endsection
