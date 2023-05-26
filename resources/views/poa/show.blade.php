@extends('adminlte::page')


@section('title', 'POA')

@section('content_header')
    <h1>POA</h1>
@stop

@section('content')
<br>
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

                    <div class="row">

                    <div class = "col-md-3">
                    <div class="form-group">
                            <strong>Ejercicio:</strong>
                            {{ $poa->ejercicio->ejercicioejecucion }}
                        </div>
                        </div>

                        <div class = "col-md-3">
                        <div class="form-group">
                            <strong>Institucion:</strong>
                            {{ $poa->institucione->institucion }}
                        </div>
                        </div>

                        <div class = "col-md-3">
                        <div class="form-group">
                            <strong>Historico:</strong>
                            {{ $poa->objetivoshistorico->objetivo }}
                        </div>
                        </div>

                        <div class = "col-md-3">
                        <div class="form-group">
                            <strong>Nacional:</strong>
                            {{ $poa->objetivonacionale->objetivo }}
                        </div>
                        </div>

                        <div class = "col-md-3">
                        <div class="form-group">
                            <strong>Estrategico:</strong>
                            {{ $poa->objetivosestrategico->objetivo }}
                        </div>
                        </div>

                        <div class = "col-md-3">
                        <div class="form-group">
                            <strong>General:</strong>
                            {{ $poa->objetivogenerale->objetivo }}
                        </div>
                        </div>

                        <div class = "col-md-3">
                        <div class="form-group">
                            <strong>Municipal:</strong>
                            {{ $poa->objetivomunicipale->objetivo }}
                        </div>
                        </div>

                        <div class = "col-md-3">
                        <div class="form-group">
                            <strong>PEI:</strong>
                            {{ $poa->objetivopei->objetivo }}
                        </div>
                        </div>

                        <div class = "col-md-3">
                        <div class="form-group">
                            <strong>Unidad administrativa:</strong>
                            {{ $poa->unidadadministrativa->unidadejecutora }}
                        </div>
                        </div>

                        <div class = "col-md-3">
                        <div class="form-group">
                            <strong>Proyecto:</strong>
                            {{ $poa->proyecto }}
                        </div>
                        </div>

                        <div class = "col-md-3">
                        <div class="form-group">
                            <strong>Objetivo proyecto:</strong>
                            {{ $poa->objetivoproyecto }}
                        </div>
                        </div>

                        <div class = "col-md-3">
                        <div class="form-group">
                            <strong>Monto proyecto:</strong>
                            {{ $poa->montoproyecto }}
                        </div>
                        </div>

                        <div class = "col-md-3">
                        <div class="form-group">
                            <strong>Responsable:</strong>
                            {{ $poa->responsable }}
                        </div>
                        </div>

                        <div class = "col-md-3">
                        <div class="form-group">
                            <strong>Tipo:</strong>
                            {{ $poa->tipo }}
                        </div>
                        </div>

                        <div class = "col-md-3">
                        <div class="form-group">
                            <strong>SNCF estrategico:</strong>
                            {{ $poa->sncfestrategico }}
                        </div>
                        </div>

                        <div class = "col-md-3">
                        <div class="form-group">
                            <strong>SNCF especifico:</strong>
                            {{ $poa->sncfespecifico }}
                        </div>
                        </div>

                        <div class = "col-md-3">
                        <div class="form-group">
                            <strong>P. social:</strong>
                            {{ $poa->psocial }}
                        </div>
                        </div>

                        <div class = "col-md-3">
                        <div class="form-group">
                            <strong>Codigo:</strong>
                            {{ $poa->codigo }}
                        </div>
                        </div>

                        <div class = "col-md-3">
                        <div class="form-group">
                            <strong>Tipo proyecto:</strong>
                            {{ $poa->tipoproyecto }}
                        </div>
                        </div>

                        <div class = "col-md-3">
                        <div class="form-group">
                            <strong>Central:</strong>
                            {{ $poa->central }}
                        </div>
                        </div>

                        <div class = "col-md-3">
                        <div class="form-group">
                            <strong>Descripcion:</strong>
                            {{ $poa->descripcion }}
                        </div>
                        </div>

                        <div class = "col-md-3">
                        <div class="form-group">
                            <strong>Usuario:</strong>
                            {{ $poa->usuario->name }}
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
    
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous"/>
    <link rel="stylesheet" href="{{ asset('css/submit.css') }}">
        
    @stop
    
    @section('js')
    <script src="{{ asset('js/submit.js') }}"></script>
    
    
    @stop
