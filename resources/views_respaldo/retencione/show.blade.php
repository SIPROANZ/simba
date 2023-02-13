@extends('layouts.app')

@section('template_title')
    {{ $retencione->name ?? 'Ver Retenciones' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Ver Retenciones</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('retenciones.index') }}"> Regresar</a>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="form-group">
                            <strong>Descripcion:</strong>
                            {{ $retencione->descripcion }}
                        </div>
                        <div class="form-group">
                            <strong>Porcentaje:</strong>
                            {{ $retencione->porcentaje }}
                        </div>
                        <div class="form-group">
                            <strong>Tipo:</strong>
                            @if ($retencione->tipo == 'I')
                                Impuesto
                            @else
                                Retencion
                            @endif
                        </div>
                        <div class="form-group">
                            <strong>Tipo de Retención:</strong>
                            {{ $retencione->tiporetencione->tipo }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
