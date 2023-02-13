@extends('adminlte::page')

@section('title', 'Comprobantes de Retenciones')

@section('content_header')
    <h1>Comprobantes de Retenciones</h1>
@stop

@section('content')
<br>
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Mostrar Comprobantes retencione</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('comprobantesretenciones.index') }}"> Regresar</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Tipo retencion:</strong>
                            {{ $comprobantesretencione->tiporetencione->tipo }}
                        </div>
                        <div class="form-group">
                            <strong>Orden pago:</strong>
                            {{ $comprobantesretencione->ordenpago->nordenpago }}
                        </div>
                        <div class="form-group">
                            <strong>Monto retencion:</strong>
                            {{ number_format($comprobantesretencione->montoretencion,2,',','.') }}
                        </div>
                        <div class="form-group">
                            <strong>Status:</strong>
                            {{ $comprobantesretencione->status }}
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
