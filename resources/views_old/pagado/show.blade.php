@extends('adminlte::page')


@section('title', 'Pagado')

@section('content_header')
    <h1>Pagado</h1>
@stop

@section('content')
<br>
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Mostrar Pagado</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('pagados.index') }}"> Regresar</a>
                        </div>
                    </div>

                    <div class="card-body">

                    <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group">
                            <strong>Orden pago:</strong>
                            {{ $pagado->ordenpago_id }}
                        </div>
                        </div>

                        <div class="col-sm-3">
                        <div class="form-group">
                            <strong>Beneficiario:</strong>
                            {{ $pagado->beneficiario->nombre }}
                        </div>
                        </div>

                        <div class="col-sm-3">
                        <div class="form-group">
                            <strong>Monto Orden de Pago:</strong>
                            {{ $pagado->montoordenpago }}
                        </div>
                        </div>

                        <div class="col-sm-3">
                        <div class="form-group">
                            <strong>Monto pagado:</strong>
                            {{ $pagado->montopagado }}
                        </div>
                        </div>
                        
                        <div class="col-sm-3">
                        <div class="form-group">
                            <strong>Estado:</strong>
                            @if($pagado->status == 'EP')
                             EN PROCESO
                            @endif
                            @if($pagado->status == 'PR')
                              PROCESADA
                            @endif
                            @if($pagado->status == 'AN')
                              ANULADA 
                            @endif
                            @if($pagado->status == 'AP')
                             APROBADA
                            @endif
                        </div>
                        </div>

                        <div class="col-sm-3">
                        <div class="form-group">
                            <strong>Tipo orden pago:</strong>

                            @if($pagado->tipoordenpago == 1)
                              CON IMPUTACION 
                            @endif

                            @if($pagado->tipoordenpago == 2)
                             SIN IMPUTACION 
                            @endif

                        </div>
                        </div>

                        <div class="col-sm-3">
                        <div class="form-group">
                            <strong>Tipo de pago:</strong>
                            {{ $pagado->tipomovimiento->descripcion}}
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
