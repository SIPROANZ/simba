@extends('layouts.app')

@section('template_title')
    {{ $modificacione->name ?? 'Show Modificacione' }}
@endsection

@section('content')
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
@endsection
