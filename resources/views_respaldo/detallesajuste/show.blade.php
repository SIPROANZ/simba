@extends('layouts.app')

@section('template_title')
    {{ $detallesajuste->name ?? 'Show Detallesajuste' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Detallesajuste</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('detallesajustes.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Montoajuste:</strong>
                            {{ $detallesajuste->montoajuste }}
                        </div>
                        <div class="form-group">
                            <strong>Ajustes Id:</strong>
                            {{ $detallesajuste->ajustes_id }}
                        </div>
                        <div class="form-group">
                            <strong>Unidadadministrativa Id:</strong>
                            {{ $detallesajuste->unidadadministrativa_id }}
                        </div>
                        <div class="form-group">
                            <strong>Ejecucion Id:</strong>
                            {{ $detallesajuste->ejecucion_id }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
