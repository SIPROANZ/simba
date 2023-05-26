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
                            <span class="card-title">Show Modificacione</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('modificaciones.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Numero:</strong>
                            {{ $modificacione->numero }}
                        </div>
                        <div class="form-group">
                            <strong>Tipomodificacion Id:</strong>
                            {{ $modificacione->tipomodificacion_id }}
                        </div>
                        <div class="form-group">
                            <strong>Descripcion:</strong>
                            {{ $modificacione->descripcion }}
                        </div>
                        <div class="form-group">
                            <strong>Status:</strong>
                            {{ $modificacione->status }}
                        </div>
                        <div class="form-group">
                            <strong>Fechaanulacion:</strong>
                            {{ $modificacione->fechaanulacion }}
                        </div>
                        <div class="form-group">
                            <strong>Montocredita:</strong>
                            {{ $modificacione->montocredita }}
                        </div>
                        <div class="form-group">
                            <strong>Montodebita:</strong>
                            {{ $modificacione->montodebita }}
                        </div>
                        <div class="form-group">
                            <strong>Ncredito:</strong>
                            {{ $modificacione->ncredito }}
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
