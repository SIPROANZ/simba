@extends('adminlte::page')

@section('title', 'Clases')

@section('content_header')
    <h1>Clases</h1>
@stop

@section('content')
<br>
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Mostrar Clase</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('clases.index') }}"> Volver</a>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="form-group">
                            <strong>Codigoclase:</strong>
                            {{ $clase->codigoclase }}
                        </div>
                        <div class="form-group">
                            <strong>Nombre:</strong>
                            {{ $clase->nombre }}
                        </div>
                        <div class="form-group">
                            <strong>Familia Id:</strong>
                            {{ $clase->familia_id }}
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
