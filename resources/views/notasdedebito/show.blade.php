@extends('adminlte::page')

@section('title', 'Notas de Debito')

@section('content_header')
    <h1>Notas de Debito</h1>
@stop

@section('content')
<br>
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Mostrar Notas de debito</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('notasdedebitos.index') }}"> Regresar</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                    <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group">
                            <strong>Ejercicio:</strong>
                            {{ $notasdedebito->ejercicio->ejercicioejecucion }}
                        </div>
                        </div>

                        <div class="col-sm-3">
                        <div class="form-group">
                            <strong>Institucion:</strong>
                            {{ $notasdedebito->institucione->institucion }}
                        </div>
                        </div>

                        <div class="col-sm-3">
                        <div class="form-group">
                            <strong>Beneficiario:</strong>
                            {{ $notasdedebito->beneficiario->nombre }}
                        </div>
                        </div>

                        <div class="col-sm-3">
                        <div class="form-group">
                            <strong>Banco Id:</strong>
                            {{ $notasdedebito->banco->denominacion }}
                        </div>
                        </div>

                        <div class="col-sm-3">
                        <div class="form-group">
                            <strong>Cuenta bancaria:</strong>
                            {{ $notasdedebito->cuentasbancaria->cuenta }}
                        </div>
                        </div>

                        <div class="col-sm-3">
                        <div class="form-group">
                            <strong>Fecha:</strong>
                            {{ $notasdedebito->fecha }}
                        </div>
                        </div>

                        <div class="col-sm-3">
                        <div class="form-group">
                            <strong>Referencia:</strong>
                            {{ $notasdedebito->referencia }}
                        </div>
                        </div>

                        <div class="col-sm-3">
                        <div class="form-group">
                            <strong>Descripcion:</strong>
                            {{ $notasdedebito->descripcion }}
                        </div>
                        </div>

                        <div class="col-sm-3">
                        <div class="form-group">
                            <strong>Monto:</strong>
                            {{ $notasdedebito->monto }}
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
