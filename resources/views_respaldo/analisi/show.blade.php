@extends('adminlte::page')

@section('template_title')
    {{ $analisi->name ?? 'Show Analisi' }}
@endsection

@section('content')
<br>
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Mostrar Analisis</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('analisis.index') }}"> Regresar</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Unidad administrativa:</strong>
                            {{ $analisi->unidadadministrativa_id }}
                        </div>
                        <div class="form-group">
                            <strong>Requisicion:</strong>
                            {{ $analisi->requisicion_id }}
                        </div>
                        <div class="form-group">
                            <strong>Criterio:</strong>
                            {{ $analisi->criterio_id }}
                        </div>
                        <div class="form-group">
                            <strong>Numer0:</strong>
                            {{ $analisi->numeracion }}
                        </div>
                        <div class="form-group">
                            <strong>Observacion:</strong>
                            {{ $analisi->observacion }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
