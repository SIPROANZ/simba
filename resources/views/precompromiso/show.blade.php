@extends('adminlte::page')

@section('title', 'Mostrar Precompromisos')

@section('content_header')
    <h1>Precompromisos</h1>
@stop

@section('content')
<br>
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Mostrar Precompromiso</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('precompromisos.index') }}"> Regresar</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Documento:</strong>
                            {{ $precompromiso->documento }}
                        </div>
                        <div class="form-group">
                            <strong>Monto total:</strong>
                            {{ $precompromiso->montototal }}
                        </div>
                        <div class="form-group">
                            <strong>Concepto:</strong>
                            <td>{!! $precompromiso->concepto !!}</td>
                        </div>
                        <div class="form-group">
                            <strong>Fecha anulacion:</strong>
                            {{ $precompromiso->fechaanulacion }}
                        </div>
                        <div class="form-group">
                            <strong>Unidad administrativa:</strong>
                            {{ $precompromiso->unidadadministrativa_id }}
                        </div>
                        <div class="form-group">
                            <strong>Tipo compromiso:</strong>
                            {{ $precompromiso->tipocompromiso_id }}
                        </div>
                        <div class="form-group">
                            <strong>Beneficiario:</strong>
                            {{ $precompromiso->beneficiario_id }}
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

