@extends('layouts.app')

@section('template_title')
    {{ $detallepagado->name ?? 'Show Detallepagado' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Detallepagado</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('detallepagados.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Pagado Id:</strong>
                            {{ $detallepagado->pagado_id }}
                        </div>
                        <div class="form-group">
                            <strong>Ordenpago Id:</strong>
                            {{ $detallepagado->ordenpago_id }}
                        </div>
                        <div class="form-group">
                            <strong>Unidadadministrativa Id:</strong>
                            {{ $detallepagado->unidadadministrativa_id }}
                        </div>
                        <div class="form-group">
                            <strong>Ejecucion Id:</strong>
                            {{ $detallepagado->ejecucion_id }}
                        </div>
                        <div class="form-group">
                            <strong>Montopagado:</strong>
                            {{ $detallepagado->montopagado }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
