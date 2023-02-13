@extends('layouts.app')

@section('template_title')
    {{ $objetivogenerale->name ?? 'Show Objetivogenerale' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Mostrar Objetivo generales</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('objetivogenerales.index') }}"> Volver</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Objetivogeneral:</strong>
                            {{ $objetivogenerale->objetivogeneral }}
                        </div>
                        <div class="form-group">
                            <strong>Objetivo:</strong>
                            {{ $objetivogenerale->objetivo }}
                        </div>
                        <div class="form-group">
                            <strong>Estrategico Id:</strong>
                            {{ $objetivogenerale->estrategico_id }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
