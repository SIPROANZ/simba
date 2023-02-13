@extends('adminlte::page')

@section('title', 'Clasificador Presupuestario de la Compra')

@section('content_header')
    <h1>Clasificador Presupuestario de la Compra</h1>
@stop

@section('content')
<br>
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Comprascp</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('comprascps.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="form-group">
                            <strong>Compra Id:</strong>
                            {{ $comprascp->compra_id }}
                        </div>
                        <div class="form-group">
                            <strong>Unidadadministrativa Id:</strong>
                            {{ $comprascp->unidadadministrativa_id }}
                        </div>
                        <div class="form-group">
                            <strong>Ejecucion Id:</strong>
                            {{ $comprascp->ejecucion_id }}
                        </div>
                        <div class="form-group">
                            <strong>Monto:</strong>
                            {{ $comprascp->monto }}
                        </div>
                        <div class="form-group">
                            <strong>Disponible:</strong>
                            {{ $comprascp->disponible }}
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
