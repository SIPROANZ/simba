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

                    <div class="row">
                        

                        <div class="col-sm-4" style="text-align: left;">
                        <div class="form-group">

                        <div class="card" style="width: 18rem;">
                        <img src="{{ asset ($empleado->imagen) }}" class="card-img-top" alt="Imagen de Perfil del empleado">
                        <div class="card-body">
                            <p class="card-text">
                            <strong>Nombre:</strong>
                            {{ $empleado->nombre }} <br>
                            <strong>Cedula:</strong>
                            {{ $empleado->cedula }} <br>
                            <strong>Fecha de Nacimiento:</strong>
                            {{ $empleado->created_at->toDateString() }}<br>
                            <strong>Edad:</strong>
                            {{ $obj_carbon->createFromDate($obj_carbon->parse($empleado->created_at))->age }}<br>
                            <strong>Genero:</strong>
                            {{ $empleado->genero }}<br>
                            <strong>Telefono:</strong>
                            {{ $empleado->telefono }}<br>
                            <strong>Tipo:</strong>
                            {{ $empleado->tipo }}<br>
                            <strong>Unidad Administrativa / Ente / Corporacion:</strong>
                            {{ $empleado->unidade->nombre }}<br>
                            <strong>Gabinete:</strong>
                            {{ $empleado->unidade->gabinete->nombre }}
                            </p>
    
  </div>
</div>

                        </div>
                        </div>

                        

                        <div class="col-sm-8" style="text-align: center;">
                        <div class="form-group">

                        <div class="card" style="width: 36rem;">
                        <img src="{{ asset ($empleado->imagencedula) }}" class="card-img-top" alt="Imagen de cedula del empleado">
                        <div class="card-body">
                            <p class="card-text">Imagen de la cédula</p>
                        </div>
                        </div>

                        </div>
                        </div>

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
