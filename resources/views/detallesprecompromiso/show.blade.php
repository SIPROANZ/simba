@extends('adminlte::page')

@section('title', 'Precompromiso')

@section('content_header')
    <h1>Agregar Detalles Precompromiso</h1>
@stop

@section('content')
<br>
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Mostrar Detalles precompromisos</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('detallesprecompromisos.index') }}"> Regresar</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Montocompromiso:</strong>
                            {{ $detallesprecompromiso->montocompromiso }}
                        </div>
                        <div class="form-group">
                            <strong>Precompromiso Id:</strong>
                            {{ $detallesprecompromiso->precompromiso_id }}
                        </div>
                        <div class="form-group">
                            <strong>Unidadadministrativa Id:</strong>
                            {{ $detallesprecompromiso->unidadadministrativa_id }}
                        </div>
                        <div class="form-group">
                            <strong>Ejecucion Id:</strong>
                            {{ $detallesprecompromiso->ejecucion_id }}
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
