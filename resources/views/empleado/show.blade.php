@extends('adminlte::page')


@section('title', 'Empleados')

@section('content_header')
    <h1>Empleados</h1>
@stop

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Empleado</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('empleados.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Nombre:</strong>
                            {{ $empleado->nombre }}
                        </div>
                        <div class="form-group">
                            <strong>Cedula:</strong>
                            {{ $empleado->cedula }}
                        </div>
                        <div class="form-group">
                            <strong>Genero:</strong>
                            {{ $empleado->genero }}
                        </div>
                        <div class="form-group">
                            <strong>Telefono:</strong>
                            {{ $empleado->telefono }}
                        </div>
                        <div class="form-group">
                            <strong>Tipo:</strong>
                            {{ $empleado->tipo }}
                        </div>
                        <div class="form-group">
                            <strong>Unidad Id:</strong>
                            {{ $empleado->unidad_id }}
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
