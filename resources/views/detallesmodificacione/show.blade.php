@extends('adminlte::page')

@section('title', 'Modificaciones')

@section('content_header')
    <h1>Modificaciones</h1>
@stop

@section('content')
<br>
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Detallesmodificacione</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('detallesmodificaciones.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Modificacion Id:</strong>
                            {{ $detallesmodificacione->modificacion_id }}
                        </div>
                        <div class="form-group">
                            <strong>Unidadadministrativa Id:</strong>
                            {{ $detallesmodificacione->unidadadministrativa_id }}
                        </div>
                        <div class="form-group">
                            <strong>Ejecucion Id:</strong>
                            {{ $detallesmodificacione->ejecucion_id }}
                        </div>
                        <div class="form-group">
                            <strong>Montoacredita:</strong>
                            {{ $detallesmodificacione->montoacredita }}
                        </div>
                        <div class="form-group">
                            <strong>Montodebita:</strong>
                            {{ $detallesmodificacione->montodebita }}
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
