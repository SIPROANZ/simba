@extends('layouts.app')

@section('template_title')
    {{ $detalleordenpago->name ?? 'Show Detalleordenpago' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Detalleordenpago</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('detalleordenpagos.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Ordenpago Id:</strong>
                            {{ $detalleordenpago->ordenpago_id }}
                        </div>
                        <div class="form-group">
                            <strong>Unidadadministrativa Id:</strong>
                            {{ $detalleordenpago->unidadadministrativa_id }}
                        </div>
                        <div class="form-group">
                            <strong>Ejecucion Id:</strong>
                            {{ $detalleordenpago->ejecucion_id }}
                        </div>
                        <div class="form-group">
                            <strong>Monto:</strong>
                            {{ $detalleordenpago->monto }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
