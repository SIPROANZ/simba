@extends('adminlte::page')


@section('title', 'Movimientos Bancarios')

@section('content_header')
    <h1>Movimientos Bancarios</h1>
@stop

@section('content')
<br>
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Movimientosbancario</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('movimientosbancarios.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Ejercicio:</strong>
                            {{ $movimientosbancario->ejercicio_id }}
                        </div>
                        <div class="form-group">
                            <strong>Institucion:</strong>
                            {{ $movimientosbancario->institucion_id }}
                        </div>
                        <div class="form-group">
                            <strong>Cuentasbancaria:</strong>
                            {{ $movimientosbancario->cuentasbancaria_id }}
                        </div>
                        <div class="form-group">
                            <strong>Beneficiario:</strong>
                            {{ $movimientosbancario->beneficiario_id }}
                        </div>
                        <div class="form-group">
                            <strong>Tipomovimiento:</strong>
                            {{ $movimientosbancario->tipomovimiento_id }}
                        </div>
                        <div class="form-group">
                            <strong>Referencia:</strong>
                            {{ $movimientosbancario->referencia }}
                        </div>
                        <div class="form-group">
                            <strong>Descripcion:</strong>
                            {{ $movimientosbancario->descripcion }}
                        </div>
                        <div class="form-group">
                            <strong>Fecha:</strong>
                            {{ $movimientosbancario->fecha }}
                        </div>
                        <div class="form-group">
                            <strong>Monto:</strong>
                            {{ $movimientosbancario->monto }}
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
