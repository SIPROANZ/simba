@extends('layouts.app')

@section('template_title')
    {{ $objetivonacionale->name ?? 'Show Objetivonacionale' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Ver Objetivo Nacional</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('objetivonacionales.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>numeral:</strong>
                            {{ $objetivonacionale->objetivonacional }}
                        </div>
                        <div class="form-group">
                            <strong>Objetivo Nacional:</strong>
                            {{ $objetivonacionale->objetivo }}
                        </div>
                        <div class="form-group">
                            <strong>Objetivo Historico:</strong>
                            {{ $objetivonacionale->historico_id }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
