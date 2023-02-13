@extends('adminlte::page')


@section('title', 'Transferencia entre cuentas')

@section('content_header')
    <h1>Transferencia entre cuentas</h1>
@stop

@section('content')
<br>
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Mostrar Transferencia entre cuenta</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('transferenciaentrecuentas.index') }}"> Regresar</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                    <div class="row">
                        <div class="col-md-3">
                        <div class="form-group">
                            <strong>Monto:</strong>
                            {{ $transferenciaentrecuenta->monto }}
                        </div>
                        </div>

                        <div class="col-md-3">
                        <div class="form-group">
                            <strong>Fecha:</strong>
                            {{ $transferenciaentrecuenta->fecha }}
                        </div>
                        </div>

                        <div class="col-md-3">
                        <div class="form-group">
                            <strong>Referencia:</strong>
                            {{ $transferenciaentrecuenta->referencia }}
                        </div>
                        </div>

                        <div class="col-md-3">
                        <div class="form-group">
                            <strong>Descripcion:</strong>
                            {{ $transferenciaentrecuenta->descripcion }}
                        </div>
                        </div>

                        <div class="col-md-3">
                        <div class="form-group">
                            <strong>Banco origen:</strong>
                            {{ $transferenciaentrecuenta->banco->denominacion }}
                        </div>
                        </div>

                        <div class="col-md-3">
                        <div class="form-group">
                            <strong>Cuenta origen:</strong>
                            {{ $transferenciaentrecuenta->cuentasbancaria->cuenta }}
                        </div>
                        </div>

                        <div class="col-md-3">
                        <div class="form-group">
                            <strong>Banco destino:</strong>
                            {{ $transferenciaentrecuenta->bancodestino->denominacion }}
                        </div>
                        </div>

                        <div class="col-md-3">
                        <div class="form-group">
                            <strong>Cuenta destino:</strong>
                            {{ $transferenciaentrecuenta->cuentasbancariadestino->cuenta }}
                        </div>
                        </div></div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    @stop

@section('css')

    <link rel="stylesheet" href="/css/admin_custom.css">
@stop
