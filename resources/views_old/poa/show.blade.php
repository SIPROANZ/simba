@extends('layouts.app')

@section('template_title')
    {{ $poa->name ?? 'Show Poa' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Ver Plan operativo anual</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('poas.index') }}"> Regresar</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Ejercicio:</strong>
                            {{ $poa->ejercicio_id }}
                        </div>
                        <div class="form-group">
                            <strong>Institucion:</strong>
                            {{ $poa->institucion_id }}
                        </div>
                        <div class="form-group">
                            <strong>Historico:</strong>
                            {{ $poa->historico_id }}
                        </div>
                        <div class="form-group">
                            <strong>Nacional:</strong>
                            {{ $poa->nacional_id }}
                        </div>
                        <div class="form-group">
                            <strong>Estrategico:</strong>
                            {{ $poa->estrategico_id }}
                        </div>
                        <div class="form-group">
                            <strong>General:</strong>
                            {{ $poa->general_id }}
                        </div>
                        <div class="form-group">
                            <strong>Municipal:</strong>
                            {{ $poa->municipal_id }}
                        </div>
                        <div class="form-group">
                            <strong>PEI:</strong>
                            {{ $poa->pei_id }}
                        </div>
                        <div class="form-group">
                            <strong>Unidad administrativa:</strong>
                            {{ $poa->unidadadministrativa_id }}
                        </div>
                        <div class="form-group">
                            <strong>Proyecto:</strong>
                            {{ $poa->proyecto }}
                        </div>
                        <div class="form-group">
                            <strong>Objetivo proyecto:</strong>
                            {{ $poa->objetivoproyecto }}
                        </div>
                        <div class="form-group">
                            <strong>Monto proyecto:</strong>
                            {{ $poa->montoproyecto }}
                        </div>
                        <div class="form-group">
                            <strong>Responsable:</strong>
                            {{ $poa->responsable }}
                        </div>
                        <div class="form-group">
                            <strong>Tipo:</strong>
                            {{ $poa->tipo }}
                        </div>
                        <div class="form-group">
                            <strong>SNCF estrategico:</strong>
                            {{ $poa->sncfestrategico }}
                        </div>
                        <div class="form-group">
                            <strong>SNCF especifico:</strong>
                            {{ $poa->sncfespecifico }}
                        </div>
                        <div class="form-group">
                            <strong>P. social:</strong>
                            {{ $poa->psocial }}
                        </div>
                        <div class="form-group">
                            <strong>Codigo:</strong>
                            {{ $poa->codigo }}
                        </div>
                        <div class="form-group">
                            <strong>Tipo proyecto:</strong>
                            {{ $poa->tipoproyecto }}
                        </div>
                        <div class="form-group">
                            <strong>Central:</strong>
                            {{ $poa->central }}
                        </div>
                        <div class="form-group">
                            <strong>Descripcion:</strong>
                            {{ $poa->descripcion }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
