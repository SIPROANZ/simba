@extends('adminlte::page')

@section('title', 'Transferencias')

@section('content_header')
    <h1>Transferencias</h1>
@stop

@section('content')
<br>
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Transferencia</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('transferencias.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="form-group">
                            <strong>Cuentasbancaria Id:</strong>
                            {{ $transferencia->cuentasbancaria_id }}
                        </div>
                        <div class="form-group">
                            <strong>Beneficiario Id:</strong>
                            {{ $transferencia->beneficiario_id }}
                        </div>
                        <div class="form-group">
                            <strong>Pagado Id:</strong>
                            {{ $transferencia->pagado_id }}
                        </div>
                        <div class="form-group">
                            <strong>Montotransferencia:</strong>
                            {{ $transferencia->montotransferencia }}
                        </div>
                        <div class="form-group">
                            <strong>Fechaanulacion:</strong>
                            {{ $transferencia->fechaanulacion }}
                        </div>
                        <div class="form-group">
                            <strong>Concepto:</strong>
                            {{ $transferencia->concepto }}
                        </div>
                        <div class="form-group">
                            <strong>Egreso:</strong>
                            {{ $transferencia->egreso }}
                        </div>
                        <div class="form-group">
                            <strong>Montoorden:</strong>
                            {{ $transferencia->montoorden }}
                        </div>
                        <div class="form-group">
                            <strong>Referenciabancaria:</strong>
                            {{ $transferencia->referenciabancaria }}
                        </div>
                        <div class="form-group">
                            <strong>Conceptoanulacion:</strong>
                            {{ $transferencia->conceptoanulacion }}
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
