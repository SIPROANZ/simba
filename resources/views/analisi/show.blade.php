@extends('adminlte::page')


@section('title', 'Analisis de Cotizacion')

@section('content_header')
    <h1>Analisis de Cotizacion</h1>
@stop

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
                    <div class="row">
  <!-- Select Dinamicos -->

  <div class="col-md-3">
                        <div class="form-group">
                            <strong>Unidad administrativa:</strong>
                            {{ $analisi->unidadadministrativa->unidadejecutora }}
                        </div>
                        </div>

                        <div class="col-md-3">
                        <div class="form-group">
                            <strong>Requisicion:</strong>
                            {{ $analisi->requisicione->correlativo }}
                        </div>
                        </div>

                        <div class="col-md-3">
                        <div class="form-group">
                            <strong>Criterio:</strong>
                            {{ $analisi->criterio->nombre }}
                        </div>
                        </div>

                        <div class="col-md-3">
                        <div class="form-group">
                            <strong>Numero de Cotizacion:</strong>
                            {{ $analisi->numeracion }}
                        </div>
                        </div>

                        <div class="col-md-3">
                        <div class="form-group">
                            <strong>Observacion:</strong>
                            {{ $analisi->observacion }}
                        </div>

                        </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    @stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop
