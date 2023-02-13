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
   
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop
