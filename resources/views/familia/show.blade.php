@extends('adminlte::page')

@section('title', 'Familia')

@section('content_header')
    <h1>Familia</h1>
@stop

@section('content')
<br>
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Ver Familia de BOS</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('familias.index') }}"> Regresar</a>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="form-group">
                            <strong>Codigo:</strong>
                            {{ $familia->codigofamilia }}
                        </div>
                        <div class="form-group">
                            <strong>Nombre:</strong>
                            {{ $familia->nombre }}
                        </div>
                        <div class="form-group">
                            <strong>Segmento:</strong>
                            {{ $familia->segmento->nombre }}
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
