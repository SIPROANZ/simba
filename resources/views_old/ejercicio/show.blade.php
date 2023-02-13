@extends('adminlte::page')

@section('title', 'Ejercicio Fiscal')

@section('content_header')
    <h1>Ejercicio Fiscal</h1>
@stop

@section('content')
<br>
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Mostrar Ejercicio</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('ejercicios.index') }}">Volver</a>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="form-group">
                            <strong>Nombre Ejercicio:</strong>
                            {{ $ejercicio->nombreejercicio }}
                        </div>
                        <div class="form-group">
                            <strong>Ejercicio Origen:</strong>
                            {{ $ejercicio->ejercicioorigen }}
                        </div>
                        <div class="form-group">
                            <strong>Ejercicio Ejecución:</strong>
                            {{ $ejercicio->ejercicioejecucion }}
                        </div>
                        <div class="form-group">
                            <strong>Status:</strong>
                            {{ $ejercicio->estatus }}
                        </div>
                        <div class="form-group">
                            <strong>Observación:</strong>
                            {{ $ejercicio->observacion }}
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
