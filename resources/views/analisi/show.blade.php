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
    
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous"/>
    <link rel="stylesheet" href="{{ asset('css/submit.css') }}">
        
    @stop
    
    @section('js')
    <script src="{{ asset('js/submit.js') }}"></script>
    
    
    @stop
