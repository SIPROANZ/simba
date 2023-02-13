@extends('adminlte::page')

@section('title', 'Objetivo PEI')

@section('content_header')
    <h1>Objetivo PEI</h1>
@stop

@section('content')
<br>
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Ver Objetivo PEI</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('objetivopeis.index') }}"> Regresar</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Numeral:</strong>
                            {{ $objetivopei->objetivopei }}
                        </div>
                        <div class="form-group">
                            <strong>Objetivo PEI:</strong>
                            {{ $objetivopei->objetivo }}
                        </div>
                        <div class="form-group">
                            <strong>Objetivo Municipal:</strong>
                            {{ $objetivopei->municipal_id }}
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
