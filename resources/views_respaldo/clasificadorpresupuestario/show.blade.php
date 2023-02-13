@extends('layouts.app')

@section('template_title')
    {{ $clasificadorpresupuestario->name ?? 'Show Clasificadorpresupuestario' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Ver Clasificador Presupuestario</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('clasificadorpresupuestarios.index') }}"> Regresar</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Cuenta:</strong>
                            {{ $clasificadorpresupuestario->cuenta }}
                        </div>
                        <div class="form-group">
                            <strong>Denominacion:</strong>
                            {{ $clasificadorpresupuestario->denominacion }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
