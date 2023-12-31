@extends('adminlte::page')

@section('title', 'Financiamientos')

@section('content_header')
    <h1>Financiamientos</h1>
@stop

@section('content')
<br>
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Ver Financiamiento</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('financiamientos.index') }}"> Regresar</a>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="form-group">
                            <strong>Nombre del Financiamiento:</strong>
                            {{ $financiamiento->nombre }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
