@extends('adminlte::page')

@section('title', 'Notas de Credito')

@section('content_header')
    <h1>Notas de Credito</h1>
@stop

@section('content')
<br>
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Mostrar Nota de credito</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('notasdecreditos.index') }}"> Regresar</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                    <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group">
                            <strong>Ejercicio:</strong>
                            {{ $notasdecredito->ejercicio->ejercicioejecucion }}
                        </div>
                        </div>

                        <div class="col-sm-3">
                        <div class="form-group">
                            <strong>Institucion:</strong>
                            {{ $notasdecredito->institucione->institucion }}
                        </div>
                        </div>

                        <div class="col-sm-3">
                        <div class="form-group">
                            <strong>Beneficiario:</strong>
                            {{ $notasdecredito->beneficiario->nombre }}
                        </div>
                        </div>

                        <div class="col-sm-3">
                        <div class="form-group">
                            <strong>Banco:</strong>
                            {{ $notasdecredito->banco->denominacion }}
                        </div>
                        </div>

                        <div class="col-sm-3">
                        <div class="form-group">
                            <strong>Cuentabancaria:</strong>
                            {{ $notasdecredito->cuentasbancaria->cuenta }}
                        </div>
                        </div>

                        <div class="col-sm-3">
                        <div class="form-group">
                            <strong>Fecha:</strong>
                            {{ $notasdecredito->fecha }}
                        </div>
                        </div>

                        <div class="col-sm-3">
                        <div class="form-group">
                            <strong>Referencia:</strong>
                            {{ $notasdecredito->referencia }}
                        </div>
                        </div>

                        <div class="col-sm-3">
                        <div class="form-group">
                            <strong>Descripcion:</strong>
                            {{ $notasdecredito->descripcion }}
                        </div>
                        </div>

                        <div class="col-sm-3">
                        <div class="form-group">
                            <strong>Monto:</strong>
                            {{ number_format($notasdecredito->monto,2,',','.') }}
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
