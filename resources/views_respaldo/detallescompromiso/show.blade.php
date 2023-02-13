@extends('layouts.app')

@section('template_title')
    {{ $detallescompromiso->name ?? 'Show Detallescompromiso' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Detallescompromiso</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('detallescompromisos.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Montocompromiso:</strong>
                            {{ $detallescompromiso->montocompromiso }}
                        </div>
                        <div class="form-group">
                            <strong>Compromiso Id:</strong>
                            {{ $detallescompromiso->compromiso_id }}
                        </div>
                        <div class="form-group">
                            <strong>Unidadadministrativa Id:</strong>
                            {{ $detallescompromiso->unidadadministrativa_id }}
                        </div>
                        <div class="form-group">
                            <strong>Ejecucion Id:</strong>
                            {{ $detallescompromiso->ejecucion_id }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
