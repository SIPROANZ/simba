@extends('adminlte::page')

@section('title', 'Objetivos Nacionales')

@section('content_header')
    <h1>Objetivos Nacionales</h1>
@stop

@section('content')
<br>
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Ver Objetivos Nacionales</span>
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
    @stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop
