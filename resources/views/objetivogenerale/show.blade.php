@extends('adminlte::page')

@section('title', 'Objetivos Generales')

@section('content_header')
    <h1>Objetivos Generales</h1>
@stop

@section('content')
<br>
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Mostrar Objetivo generales</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('objetivogenerales.index') }}"> Volver</a>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="form-group">
                            <strong>Objetivogeneral:</strong>
                            {{ $objetivogenerale->objetivogeneral }}
                        </div>
                        <div class="form-group">
                            <strong>Objetivo:</strong>
                            {{ $objetivogenerale->objetivo }}
                        </div>
                        <div class="form-group">
                            <strong>Estrategico Id:</strong>
                            {{ $objetivogenerale->estrategico_id }}
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
