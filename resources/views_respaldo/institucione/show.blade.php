@extends('layouts.app')

@section('template_title')
    {{ $institucione->name ?? 'Ver Instituciones' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Ver Instituciones</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('instituciones.index') }}"> Regresar</a>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="form-group">
                            <strong>RIF:</strong>
                            {{ $institucione->rif }}
                        </div>
                        <div class="form-group">
                            <strong>Institución:</strong>
                            {{ $institucione->institucion }}
                        </div>
                        <div class="form-group">
                            <strong>Dirección:</strong>
                            {{ $institucione->direccion }}
                        </div>
                        <div class="form-group">
                            <strong>Teléfono:</strong>
                            {{ $institucione->telefono }}
                        </div>
                        <div class="form-group">
                            <strong>Email:</strong>
                            {{ $institucione->email }}
                        </div>
                        <div class="form-group">
                            <strong>Base Legal:</strong>
                            {{ $institucione->baselegal }}
                        </div>
                        <div class="form-group">
                            <strong>Pagina Web:</strong>
                            {{ $institucione->web }}
                        </div>
                        <div class="form-group">
                            <strong>Codigo Postal:</strong>
                            {{ $institucione->codigopostal }}
                        </div>
                        <div class="form-group">
                            <strong>Organigrama:</strong>
                            {{ $institucione->organigrama }}
                        </div>
                        <div class="form-group">
                            <strong>Logo:</strong>
                            {{ $institucione->logoinstitucion }}
                        </div>
                        <div class="form-group">
                            <strong>Visión:</strong>
                            {{ $institucione->vision }}
                        </div>
                        <div class="form-group">
                            <strong>Misión:</strong>
                            {{ $institucione->mision }}
                        </div>
                        <div class="form-group">
                            <strong>Razon Social:</strong>
                            {{ $institucione->razonsocial }}
                        </div>
                        <div class="form-group">
                            <strong>Municipio:</strong>
                            {{ $institucione->municipio_id }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
