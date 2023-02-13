@extends('layouts.app')

@section('template_title')
    {{ $objetivosestrategico->name ?? 'Show Objetivosestrategico' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Ver Objetivo Estrategico</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('objetivosestrategicos.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Numeral:</strong>
                            {{ $objetivosestrategico->objetivoestrategico }}
                        </div>
                        <div class="form-group">
                            <strong>Objetivo Estrategico:</strong>
                            {{ $objetivosestrategico->objetivo }}
                        </div>
                        <div class="form-group">
                            <strong>Objetivo Nacional:</strong>
                            {{ $objetivosestrategico->nacional_id }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
