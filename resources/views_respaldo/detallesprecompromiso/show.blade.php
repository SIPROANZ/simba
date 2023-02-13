@extends('layouts.app')

@section('template_title')
    {{ $detallesprecompromiso->name ?? 'Show Detallesprecompromiso' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Detallesprecompromiso</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('detallesprecompromisos.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Montocompromiso:</strong>
                            {{ $detallesprecompromiso->montocompromiso }}
                        </div>
                        <div class="form-group">
                            <strong>Precompromiso Id:</strong>
                            {{ $detallesprecompromiso->precompromiso_id }}
                        </div>
                        <div class="form-group">
                            <strong>Unidadadministrativa Id:</strong>
                            {{ $detallesprecompromiso->unidadadministrativa_id }}
                        </div>
                        <div class="form-group">
                            <strong>Ejecucion Id:</strong>
                            {{ $detallesprecompromiso->ejecucion_id }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
