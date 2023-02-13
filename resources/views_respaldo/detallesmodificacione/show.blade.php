@extends('layouts.app')

@section('template_title')
    {{ $detallesmodificacione->name ?? 'Show Detallesmodificacione' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Detallesmodificacione</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('detallesmodificaciones.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Modificacion Id:</strong>
                            {{ $detallesmodificacione->modificacion_id }}
                        </div>
                        <div class="form-group">
                            <strong>Unidadadministrativa Id:</strong>
                            {{ $detallesmodificacione->unidadadministrativa_id }}
                        </div>
                        <div class="form-group">
                            <strong>Ejecucion Id:</strong>
                            {{ $detallesmodificacione->ejecucion_id }}
                        </div>
                        <div class="form-group">
                            <strong>Montoacredita:</strong>
                            {{ $detallesmodificacione->montoacredita }}
                        </div>
                        <div class="form-group">
                            <strong>Montodebita:</strong>
                            {{ $detallesmodificacione->montodebita }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
