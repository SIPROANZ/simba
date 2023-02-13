@extends('adminlte::page')


@extends('adminlte::page')


@section('title', 'Tipo Requisicion')

@section('content_header')
    <h1>Tipo Requisicion</h1>
@stop

@section('content')
<br>
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Mostrar Tipos Requisicion</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('tipossgps.index') }}"> Regresar</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Denominacion:</strong>
                            {{ $tipossgp->denominacion }}
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
