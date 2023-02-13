@extends('layouts.app')

@section('template_title')
    {{ $objetivoshistorico->name ?? 'Show Objetivoshistorico' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Ver Objetivo Historico</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('objetivoshistoricos.index') }}"> Regresar</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Objetivo:</strong>
                            {{ $objetivoshistorico->objetivo }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
