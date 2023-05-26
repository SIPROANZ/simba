@extends('adminlte::page')

@section('title', 'Mostrar Ayuda Social')

@section('content_header')
    <h1>Mostrar Ayuda Social</h1>
@stop

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Mostrar Ayuda social</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('ayudassociales.index') }}"> Regresar</a>
                        </div>
                    </div>

                    <div class="card-body">

                    <div class="row">
    <div class="col-md-3">
                        <div class="form-group">
                            <strong>Beneficiario:</strong>
                            {{ $ayudassociale->beneficiario->nombre }}
                        </div>
                        </div>

                        <div class="col-md-3">
                        <div class="form-group">
                            <strong>Documento:</strong>
                            {{ $ayudassociale->documento }}
                        </div>
                        </div>

                        <div class="col-md-3">
                        <div class="form-group">
                            <strong>Monto total de la ayuda:</strong>
                            {{ $ayudassociale->montototal }}
                        </div>
                        </div>

                        <div class="col-md-3">
                        <div class="form-group">
                            <strong>Concepto:</strong>
                            {{ $ayudassociale->concepto }}
                        </div>
                        </div>

                        <div class="col-md-3">
                        <div class="form-group">
                            <strong>Unidad administrativa:</strong>
                            {{ $ayudassociale->unidadadministrativa->denominacion }}
                        </div>
                        </div>

                        <div class="col-md-3">
                        <div class="form-group">
                            <strong>Tipo de compromiso:</strong>
                            {{ $ayudassociale->tipodecompromiso->nombre }}
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