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
                        <div class="form-group">
                            <strong>Beneficiario:</strong>
                            {{ $ayudassociale->beneficiario->nombre }}
                        </div>
                        <div class="form-group">
                            <strong>Documento:</strong>
                            {{ $ayudassociale->documento }}
                        </div>
                        <div class="form-group">
                            <strong>Monto total de la ayuda:</strong>
                            {{ $ayudassociale->montototal }}
                        </div>
                        <div class="form-group">
                            <strong>Concepto:</strong>
                            {{ $ayudassociale->concepto }}
                        </div>
                        <div class="form-group">
                            <strong>Unidad administrativa:</strong>
                            {{ $ayudassociale->unidadadministrativa->denominacion }}
                        </div>
                        <div class="form-group">
                            <strong>Tipo de compromiso:</strong>
                            {{ $ayudassociale->tipodecompromiso->nombre }}
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