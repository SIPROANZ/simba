@extends('adminlte::page')

@section('title', '  BOS (Bienes/Obras/Servicios)')

@section('content_header')
    <h1>  BOS (Bienes/ Obras / Servicios)</h1>
@stop

@section('content')
<br>
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Ver BOS</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('bos.index') }}"> Regresar</a>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="form-group">
                            <strong>Descripcion:</strong>
                            {{ $bo->descripcion }}
                        </div>
                        <div class="form-group">
                            <strong>Producto:</strong>
                            {{ $bo->producto_id }}
                        </div>
                        <div class="form-group">
                            <strong>Unidad de Medida:</strong>
                            {{ $bo->unidadmedida->nombre }}
                        </div>
                        <div class="form-group">
                            <strong>Tipo de BOS:</strong>
                            {{ $bo->tipobo->nombre }}
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
