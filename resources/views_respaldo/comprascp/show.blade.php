@extends('layouts.app')

@section('template_title')
    {{ $comprascp->name ?? 'Show Comprascp' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Comprascp</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('comprascps.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Compra Id:</strong>
                            {{ $comprascp->compra_id }}
                        </div>
                        <div class="form-group">
                            <strong>Unidadadministrativa Id:</strong>
                            {{ $comprascp->unidadadministrativa_id }}
                        </div>
                        <div class="form-group">
                            <strong>Ejecucion Id:</strong>
                            {{ $comprascp->ejecucion_id }}
                        </div>
                        <div class="form-group">
                            <strong>Monto:</strong>
                            {{ $comprascp->monto }}
                        </div>
                        <div class="form-group">
                            <strong>Disponible:</strong>
                            {{ $comprascp->disponible }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
