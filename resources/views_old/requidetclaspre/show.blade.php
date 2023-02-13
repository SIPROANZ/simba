@extends('layouts.app')

@section('template_title')
    {{ $requidetclaspre->name ?? 'Show Requidetclaspre' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Requidetclaspre</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('requidetclaspres.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Requisicion Id:</strong>
                            {{ $requidetclaspre->requisicion_id }}
                        </div>
                        <div class="form-group">
                            <strong>Poa Id:</strong>
                            {{ $requidetclaspre->poa_id }}
                        </div>
                        <div class="form-group">
                            <strong>Meta Id:</strong>
                            {{ $requidetclaspre->meta_id }}
                        </div>
                        <div class="form-group">
                            <strong>Financiamiento Id:</strong>
                            {{ $requidetclaspre->financiamiento_id }}
                        </div>
                        <div class="form-group">
                            <strong>Disponible:</strong>
                            {{ $requidetclaspre->disponible }}
                        </div>
                        <div class="form-group">
                            <strong>Claspres:</strong>
                            {{ $requidetclaspre->claspres }}
                        </div>
                        <div class="form-group">
                            <strong>Ejecucion Id:</strong>
                            {{ $requidetclaspre->ejecucion_id }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
