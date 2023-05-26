@extends('adminlte::page')

@section('title', 'Productos Clasificador presupuestario')

@section('content_header')
    <h1>Productos Clasificador presupuestario</h1>
@stop

@section('content')
<br>
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Ver Productos Clasificador presupuestario</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('productoscps.index') }}"> Regresar</a>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="form-group">
                            <strong>Producto:</strong>
                            {{ $productoscp->producto_id }}
                        </div>
                        <div class="form-group">
                            <strong>Clasificador presupuestario:</strong>
                            {{ $productoscp->clasificadorp_id }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    @stop

 @section('css')
    
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous"/>
    <link rel="stylesheet" href="{{ asset('css/submit.css') }}">
        
    @stop
    
    @section('js')
    <script src="{{ asset('js/submit.js') }}"></script>
    
    
    @stop
