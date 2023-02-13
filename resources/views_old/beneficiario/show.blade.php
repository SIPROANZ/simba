@extends('adminlte::page')


@section('title', 'Benmficiarios')

@section('content_header')
    <h1>Beneficiarios</h1>
@stop

@section('content')
<br>
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Mostrar Beneficiario</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('beneficiarios.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Persona:</strong>
                            {{ $beneficiario->caracterbeneficiario }}
                        </div>
                        <div class="form-group">
                            <strong>Cedula:</strong>
                            {{ $beneficiario->documento }}
                        </div>
                        <div class="form-group">
                            <strong>Rif:</strong>
                            {{ $beneficiario->rif }}
                        </div>
                        <div class="form-group">
                            <strong>Tipo de residencia:</strong>
                            {{ $beneficiario->tiporesidencia }}
                        </div>
                        <div class="form-group">
                            <strong>Tipo de beneficiario:</strong>
                            {{ $beneficiario->tipobeneficiario }}
                        </div>
                        <div class="form-group">
                            <strong>Tipo de contribuyente:</strong>
                            {{ $beneficiario->tipocontribuyente }}
                        </div>
                        <div class="form-group">
                            <strong>Nombre:</strong>
                            {{ $beneficiario->nombre }}
                        </div>
                        <div class="form-group">
                            <strong>Direccion:</strong>
                            {{ $beneficiario->direccion }}
                        </div>
                        <div class="form-group">
                            <strong>Telefono:</strong>
                            {{ $beneficiario->telefono }}
                        </div>
                        <div class="form-group">
                            <strong>Correo:</strong>
                            {{ $beneficiario->correo }}
                        </div>
                        <div class="form-group">
                            <strong>Banco:</strong>
                            {{ $beneficiario->banco }}
                        </div>
                        <div class="form-group">
                            <strong>Numero de cuenta:</strong>
                            {{ $beneficiario->numerocuenta }}
                        </div>
                        <div class="form-group">
                            <strong>cedula del representante:</strong>
                            {{ $beneficiario->documentorepresentante }}
                        </div>
                        <div class="form-group">
                            <strong>Nombre del representante:</strong>
                            {{ $beneficiario->nombrerepresentante }}
                        </div>
                        <div class="form-group">
                            <strong>Telefono del representante:</strong>
                            {{ $beneficiario->telefonorepresentante }}
                        </div>
                        <div class="form-group">
                            <strong>Correo del representante:</strong>
                            {{ $beneficiario->correorepresentante }}
                        </div>
                        <div class="form-group">
                            <strong>Banco del representante:</strong>
                            {{ $beneficiario->bancorepresentante }}
                        </div>
                        <div class="form-group">
                            <strong>Numero de cuenta del representante:</strong>
                            {{ $beneficiario->numerocuentarepresentante }}
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
