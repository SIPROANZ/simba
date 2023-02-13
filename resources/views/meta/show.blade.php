@extends('adminlte::page')

@section('title', 'Metas')

@section('content_header')
    <h1>Metas</h1>
@stop

@section('content')
<br>
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Ver Meta</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('metas.index') }}"> Regresar</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Plan operativo anual</strong>
                            {{ $meta->poa_id }}
                        </div>
                        <div class="form-group">
                            <strong>Cant.1:</strong>
                            {{ $meta->cantidad1 }}
                        </div>
                        <div class="form-group">
                            <strong>Cant.2:</strong>
                            {{ $meta->cantidad2 }}
                        </div>
                        <div class="form-group">
                            <strong>Cant.3:</strong>
                            {{ $meta->cantidad3 }}
                        </div>
                        <div class="form-group">
                            <strong>Cant.4:</strong>
                            {{ $meta->cantidad4 }}
                        </div>
                        <div class="form-group">
                            <strong>Meta:</strong>
                            {{ $meta->meta }}
                        </div>
                        <div class="form-group">
                            <strong>Monto:</strong>
                            {{ $meta->monto }}
                        </div>
                        <div class="form-group">
                            <strong>Ejercicio:</strong>
                            {{ $meta->ejercicio->ejercicioejecucion }}
                        </div>
                        <div class="form-group">
                            <strong>Institucion:</strong>
                            {{ $meta->institucione->institucion }}
                        </div>
                        <div class="form-group">
                            <strong>Unidad administrativa:</strong>
                            {{ $meta->unidadadministrativa->unidadejecutora }}
                        </div>
                        <div class="form-group">
                            <strong>Tipo:</strong>
                            {{ $meta->tipo }}
                        </div>
                        <div class="form-group">
                            <strong>Enero:</strong>
                            {{ $meta->enero }}
                        </div>
                        <div class="form-group">
                            <strong>Febrero:</strong>
                            {{ $meta->febrero }}
                        </div>
                        <div class="form-group">
                            <strong>Marzo:</strong>
                            {{ $meta->marzo }}
                        </div>
                        <div class="form-group">
                            <strong>Abril:</strong>
                            {{ $meta->abril }}
                        </div>
                        <div class="form-group">
                            <strong>Mayo:</strong>
                            {{ $meta->mayo }}
                        </div>
                        <div class="form-group">
                            <strong>Junio:</strong>
                            {{ $meta->junio }}
                        </div>
                        <div class="form-group">
                            <strong>Julio:</strong>
                            {{ $meta->julio }}
                        </div>
                        <div class="form-group">
                            <strong>Agosto:</strong>
                            {{ $meta->agosto }}
                        </div>
                        <div class="form-group">
                            <strong>Septiembre:</strong>
                            {{ $meta->septiembre }}
                        </div>
                        <div class="form-group">
                            <strong>Octubre:</strong>
                            {{ $meta->octubre }}
                        </div>
                        <div class="form-group">
                            <strong>Noviembre:</strong>
                            {{ $meta->noviembre }}
                        </div>
                        <div class="form-group">
                            <strong>Diciembre:</strong>
                            {{ $meta->diciembre }}
                        </div>
                        <div class="form-group">
                            <strong>Unidad medida:</strong>
                            {{ $meta->unidadmedida }}
                        </div>
                        <div class="form-group">
                            <strong>Unidad administrativa solicitante:</strong>
                            {{ $meta->unidadadministrativasolicitante }}
                        </div>
                        <div class="form-group">
                            <strong>Impacto:</strong>
                            {{ $meta->impacto }}
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
