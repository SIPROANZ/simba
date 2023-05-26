@extends('adminlte::page')

@section('title', 'Detalles de Ejecucion')

@section('content_header')
    <h1>Detalles de Ejecucion</h1>
@stop

@section('content')
<br>
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Ver detalles ejecucion</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('ejecuciondetalles.index') }}"> Regresar</a>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="form-group">
                            <strong>Ejecucion:</strong>
                            {{ $ejecuciondetalle->ejecucion_id }}
                        </div>
                        <div class="form-group">
                            <strong>Periodo Fiscal:</strong>
                            {{ $ejecuciondetalle->periodofiscal }}
                        </div>
                        <div class="form-group">
                            <strong>Institucion:</strong>
                            {{ $ejecuciondetalle->institucion_id }}
                        </div>
                        <div class="form-group">
                            <strong>Sector:</strong>
                            {{ $ejecuciondetalle->sector }}
                        </div>
                        <div class="form-group">
                            <strong>Programa:</strong>
                            {{ $ejecuciondetalle->programa }}
                        </div>
                        <div class="form-group">
                            <strong>Subprograma:</strong>
                            {{ $ejecuciondetalle->subprograma }}
                        </div>
                        <div class="form-group">
                            <strong>Proyecto:</strong>
                            {{ $ejecuciondetalle->proyecto }}
                        </div>
                        <div class="form-group">
                            <strong>Actividad:</strong>
                            {{ $ejecuciondetalle->actividad }}
                        </div>
                        <div class="form-group">
                            <strong>Cuenta:</strong>
                            {{ $ejecuciondetalle->cuenta }}
                        </div>
                        <div class="form-group">
                            <strong>Financiamiento:</strong>
                            {{ $ejecuciondetalle->financiamiento_id }}
                        </div>
                        <div class="form-group">
                            <strong>Monto Inicial:</strong>
                            {{ $ejecuciondetalle->monto_inicial }}
                        </div>
                        <div class="form-group">
                            <strong>Monto Aumento:</strong>
                            {{ $ejecuciondetalle->monto_aumento }}
                        </div>
                        <div class="form-group">
                            <strong>Monto Disminucion:</strong>
                            {{ $ejecuciondetalle->monto_disminucion }}
                        </div>
                        <div class="form-group">
                            <strong>Monto Compromisos:</strong>
                            {{ $ejecuciondetalle->monto_compromisos }}
                        </div>
                        <div class="form-group">
                            <strong>Monto Causados:</strong>
                            {{ $ejecuciondetalle->monto_causados }}
                        </div>
                        <div class="form-group">
                            <strong>Monto Pagados:</strong>
                            {{ $ejecuciondetalle->monto_pagados }}
                        </div>
                        <div class="form-group">
                            <strong>Usuarios:</strong>
                            {{ $ejecuciondetalle->logins }}
                        </div>
                        <div class="form-group">
                            <strong>Unidad Ejecutora:</strong>
                            {{ $ejecuciondetalle->unidadejecutora }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    @stop

   @section('css')
    
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous"/>
    <link rel="stylesheet" href="{{ asset('css/submit.css') }}">
        
    @stop
    
    @section('js')
    <script src="{{ asset('js/submit.js') }}"></script>
    
    
    @stop
