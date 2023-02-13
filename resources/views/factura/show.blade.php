@extends('adminlte::page')

@section('title', 'Facturas')

@section('content_header')
    <h1>Facturas</h1>
@stop

@section('content')
<br>
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Mostrar Factura</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('ordenpagos.agregarfacturas', session('ordenpago')) }}"> Regresar</a>
                        </div>
                    </div>

                    <div class="card-body">
                    
                    <div class="row">

                    <div class="col-sm-3">
                        <div class="form-group">
                            <strong>Orden pago:</strong>
                            {{ $factura->ordenpago->nordenpago }}
                        </div>
                        </div>

                        <div class="col-sm-3">
                        <div class="form-group">
                            <strong>Numero Factura:</strong>
                            {{ $factura->numero_factura }}
                        </div>
                        </div>

                        <div class="col-sm-3">
                        <div class="form-group">
                            <strong>Numero Control:</strong>
                            {{ $factura->numero_control }}
                        </div>
                        </div>

                        <div class="col-sm-3">
                        <div class="form-group">
                            <strong>Fecha:</strong>
                            {{ $factura->fecha }}
                        </div>
                        </div>

                        <div class="col-sm-3">
                        <div class="form-group">
                            <strong>Monto base:</strong>
                            {{ $factura->montobase }}
                        </div>
                        </div>


                        <div class="col-sm-3">
                        <div class="form-group">
                            <strong>Monto iva:</strong>
                            {{ $factura->montoiva }}
                        </div>
                        </div>

                        <div class="col-sm-3">
                        <div class="form-group">
                            <strong>Monto total:</strong>
                            {{ $factura->montototal }}
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
