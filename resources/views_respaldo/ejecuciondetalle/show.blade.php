@extends('layouts.app')

@section('template_title')
    {{ $ejecuciondetalle->name ?? 'Show Ejecuciondetalle' }}
@endsection

@section('content')
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
@endsection
