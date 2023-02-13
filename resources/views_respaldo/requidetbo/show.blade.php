@extends('layouts.app')

@section('template_title')
    {{ $requidetbo->name ?? 'Show Requidetbo' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Requidetbo</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('requidetbos.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Requisicion Id:</strong>
                            {{ $requidetbo->requisicion_id }}
                        </div>
                        <div class="form-group">
                            <strong>Poa Id:</strong>
                            {{ $requidetbo->poa_id }}
                        </div>
                        <div class="form-group">
                            <strong>Meta Id:</strong>
                            {{ $requidetbo->meta_id }}
                        </div>
                        <div class="form-group">
                            <strong>Financiamiento Id:</strong>
                            {{ $requidetbo->financiamiento_id }}
                        </div>
                        <div class="form-group">
                            <strong>Bos Id:</strong>
                            {{ $requidetbo->bos_id }}
                        </div>
                        <div class="form-group">
                            <strong>Undmedida Id:</strong>
                            {{ $requidetbo->undmedida_id }}
                        </div>
                        <div class="form-group">
                            <strong>Claspres:</strong>
                            {{ $requidetbo->claspres }}
                        </div>
                        <div class="form-group">
                            <strong>Descripcion:</strong>
                            {{ $requidetbo->descripcion }}
                        </div>
                        <div class="form-group">
                            <strong>Cantidad:</strong>
                            {{ $requidetbo->cantidad }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
