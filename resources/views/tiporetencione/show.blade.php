@extends('layouts.app')

@section('template_title')
    {{ $tiporetencione->name ?? 'Ver Tipo de Retención' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Ver Tipo de Retención</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('tiporetenciones.index') }}"> Regresar</a>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="form-group">
                            <strong>Tipo:</strong>
                            {{ $tiporetencione->tipo }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
