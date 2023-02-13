@extends('adminlte::page')


@section('title', 'Detalles Analisis')

@section('content_header')
    <h1>Detalles Analisis</h1>
@stop

@section('content')
<br>
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Mostrar Detalles analisis</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('detallesanalisis.index') }}"> Regresar</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Proveedor:</strong>
                            {{ $detallesanalisi->proveedor_id }}
                        </div>
                        <div class="form-group">
                            <strong>Analisis:</strong>
                            {{ $detallesanalisi->analisis_id }}
                        </div>
                        <div class="form-group">
                            <strong>Bos:</strong>
                            {{ $detallesanalisi->bos_id }}
                        </div>
                        <div class="form-group">
                            <strong>Cantidad:</strong>
                            {{ $detallesanalisi->cantidad }}
                        </div>
                        <div class="form-group">
                            <strong>Precio:</strong>
                            {{ $detallesanalisi->precio }}
                        </div>
                        <div class="form-group">
                            <strong>Subtotal:</strong>
                            {{ $detallesanalisi->subtotal }}
                        </div>
                        <div class="form-group">
                            <strong>Iva:</strong>
                            {{ $detallesanalisi->iva }}
                        </div>
                        <div class="form-group">
                            <strong>Total:</strong>
                            {{ $detallesanalisi->total }}
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
