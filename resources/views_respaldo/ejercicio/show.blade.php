@extends('layouts.app')

@section('template_title')
    {{ $ejercicio->name ?? 'Show Ejercicio' }}
@endsection

@section('content')
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
@endsection
