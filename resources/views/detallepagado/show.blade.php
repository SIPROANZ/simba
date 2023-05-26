@extends('adminlte::page')

@section('title', 'Detalle orden de pago')

@section('content_header')
    <h1>Detalle orden de pago</h1>
@stop

@section('content')
<br>
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Mostrar Detalle pagado</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('detallepagados.index') }}"> Regresar</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Pagado:</strong>
                            {{ $detallepagado->pagado_id }}
                        </div>
                        <div class="form-group">
                            <strong>Ordenpago:</strong>
                            {{ $detallepagado->ordenpago_id }}
                        </div>
                        <div class="form-group">
                            <strong>Unidad administrativa:</strong>
                            {{ $detallepagado->unidadadministrativa_id }}
                        </div>
                        <div class="form-group">
                            <strong>Ejecucion:</strong>
                            {{ $detallepagado->ejecucion_id }}
                        </div>
                        <div class="form-group">
                            <strong>Monto pagado:</strong>
                            {{ $detallepagado->montopagado }}
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

