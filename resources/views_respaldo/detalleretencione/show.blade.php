@extends('layouts.app')

@section('template_title')
    {{ $detalleretencione->name ?? 'Show Detalleretencione' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Detalleretencione</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('detalleretenciones.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Retencion Id:</strong>
                            {{ $detalleretencione->retencion_id }}
                        </div>
                        <div class="form-group">
                            <strong>Ordenpago Id:</strong>
                            {{ $detalleretencione->ordenpago_id }}
                        </div>
                        <div class="form-group">
                            <strong>Montoneto:</strong>
                            {{ $detalleretencione->montoneto }}
                        </div>
                        <div class="form-group">
                            <strong>Montoiva:</strong>
                            {{ $detalleretencione->montoIVA }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
