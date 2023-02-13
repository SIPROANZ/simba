@extends('layouts.app')

@section('template_title')
    {{ $proveedore->name ?? 'Show Proveedore' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Mostrar Proveedor</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('proveedores.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Caracterbeneficiario:</strong>
                            {{ $proveedore->caracterbeneficiario }}
                        </div>
                        <div class="form-group">
                            <strong>Documento:</strong>
                            {{ $proveedore->documento }}
                        </div>
                        <div class="form-group">
                            <strong>Rif:</strong>
                            {{ $proveedore->rif }}
                        </div>
                        <div class="form-group">
                            <strong>Tiporesidencia:</strong>
                            {{ $proveedore->tiporesidencia }}
                        </div>
                        <div class="form-group">
                            <strong>Tipobeneficiario:</strong>
                            {{ $proveedore->tipobeneficiario }}
                        </div>
                        <div class="form-group">
                            <strong>Tipocontribuyente:</strong>
                            {{ $proveedore->tipocontribuyente }}
                        </div>
                        <div class="form-group">
                            <strong>Nombre:</strong>
                            {{ $proveedore->nombre }}
                        </div>
                        <div class="form-group">
                            <strong>Direccion:</strong>
                            {{ $proveedore->direccion }}
                        </div>
                        <div class="form-group">
                            <strong>Telefono:</strong>
                            {{ $proveedore->telefono }}
                        </div>
                        <div class="form-group">
                            <strong>Correo:</strong>
                            {{ $proveedore->correo }}
                        </div>
                        <div class="form-group">
                            <strong>Banco:</strong>
                            {{ $proveedore->banco }}
                        </div>
                        <div class="form-group">
                            <strong>Numerocuenta:</strong>
                            {{ $proveedore->numerocuenta }}
                        </div>
                        <div class="form-group">
                            <strong>Documentorepresentante:</strong>
                            {{ $proveedore->documentorepresentante }}
                        </div>
                        <div class="form-group">
                            <strong>Nombrerepresentante:</strong>
                            {{ $proveedore->nombrerepresentante }}
                        </div>
                        <div class="form-group">
                            <strong>Telefonorepresentante:</strong>
                            {{ $proveedore->telefonorepresentante }}
                        </div>
                        <div class="form-group">
                            <strong>Correorepresentante:</strong>
                            {{ $proveedore->correorepresentante }}
                        </div>
                        <div class="form-group">
                            <strong>Bancorepresentante:</strong>
                            {{ $proveedore->bancorepresentante }}
                        </div>
                        <div class="form-group">
                            <strong>Numerocuentarepresentante:</strong>
                            {{ $proveedore->numerocuentarepresentante }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
