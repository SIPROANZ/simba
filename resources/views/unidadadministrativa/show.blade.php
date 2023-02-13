@extends('adminlte::page')


@section('title', 'Unidad Administrativa')

@section('content_header')
    <h1>Unidad Administrativa</h1>
@stop

@section('content')
<br>
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Mostrar Unidad administrativa</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('unidadadministrativas.index') }}">Volver</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Ejercicio Id:</strong>
                            {{ $unidadadministrativa->ejercicio_id }}
                        </div>
                        <div class="form-group">
                            <strong>Sector:</strong>
                            {{ $unidadadministrativa->sector }}
                        </div>
                        <div class="form-group">
                            <strong>Programa:</strong>
                            {{ $unidadadministrativa->programa }}
                        </div>
                        <div class="form-group">
                            <strong>Subprograma:</strong>
                            {{ $unidadadministrativa->subprograma }}
                        </div>
                        <div class="form-group">
                            <strong>Proyecto:</strong>
                            {{ $unidadadministrativa->proyecto }}
                        </div>
                        <div class="form-group">
                            <strong>Actividad:</strong>
                            {{ $unidadadministrativa->actividad }}
                        </div>
                        <div class="form-group">
                            <strong>Denominacion:</strong>
                            {{ $unidadadministrativa->denominacion }}
                        </div>
                        <div class="form-group">
                            <strong>Unidadejecutora:</strong>
                            {{ $unidadadministrativa->unidadejecutora }}
                        </div>
                        <div class="form-group">
                            <strong>Nivel:</strong>
                            {{ $unidadadministrativa->nivel }}
                        </div>
                        <div class="form-group">
                            <strong>Email:</strong>
                            {{ $unidadadministrativa->email }}
                        </div>
                        <div class="form-group">
                            <strong>Telefono:</strong>
                            {{ $unidadadministrativa->telefono }}
                        </div>
                        <div class="form-group">
                            <strong>Descripcion:</strong>
                            {{ $unidadadministrativa->descripcion }}
                        </div>
                        <div class="form-group">
                            <strong>Inversion:</strong>
                            {{ $unidadadministrativa->inversion }}
                        </div>
                        <div class="form-group">
                            <strong>Nivelejecutor:</strong>
                            {{ $unidadadministrativa->nivelejecutor }}
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
