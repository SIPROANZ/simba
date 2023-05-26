@extends('adminlte::page')

@section('title', 'Agregar Ayuda Social')

@section('content_header')
    <h1>Agregar Ayuda Social</h1>
@stop

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Mostrar Detalles ayudas</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('detallesayudas.index') }}"> Regresar</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Montocompromiso:</strong>
                            {{ $detallesayuda->montocompromiso }}
                        </div>
                        <div class="form-group">
                            <strong>Ayuda Id:</strong>
                            {{ $detallesayuda->ayuda_id }}
                        </div>
                        <div class="form-group">
                            <strong>Unidadadministrativa Id:</strong>
                            {{ $detallesayuda->unidadadministrativa_id }}
                        </div>
                        <div class="form-group">
                            <strong>Ejecucion Id:</strong>
                            {{ $detallesayuda->ejecucion_id }}
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
