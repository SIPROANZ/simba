@extends('layouts.app')

@section('template_title')
    {{ $unidadmedida->name ?? 'Show Unidadmedida' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Ver Unidad de Medida</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('unidadmedidas.index') }}"> Regresar</a>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="form-group">
                            <strong>Nombre de Unidad de Medida:</strong>
                            {{ $unidadmedida->nombre }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
