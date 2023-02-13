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
                            <a class="btn btn-primary" href="{{ route('pagados.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Ordenpago Id:</strong>
                            {{ $pagado->ordenpago_id }}
                        </div>
                        <div class="form-group">
                            <strong>Beneficiario Id:</strong>
                            {{ $pagado->beneficiario_id }}
                        </div>
                        <div class="form-group">
                            <strong>Montopagado:</strong>
                            {{ $pagado->montopagado }}
                        </div>
                        <div class="form-group">
                            <strong>Fechaanulacion:</strong>
                            {{ $pagado->fechaanulacion }}
                        </div>
                        <div class="form-group">
                            <strong>estatus:</strong>
                            {{ $pagado->estatus }}
                        </div>
                        <div class="form-group">
                            <strong>Tipoordenpago:</strong>
                            {{ $pagado->tipoordenpago }}
                        </div>

                        <div class="form-group">
                            <strong>Tipo de pago:</strong>
                            {{ $pagado->tipomovimiento->descripcion}}
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
