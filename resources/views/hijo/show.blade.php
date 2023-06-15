@extends('adminlte::page')


@section('title', 'Hijos')

@section('content_header')
    <h1>Hijos</h1>
@stop

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Hijo</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('hijos.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        
                       

                        <!-- Inicio codigo -->
                        <div class="row">
                        <div class="col-sm-12" style="text-align: left;">
                        
                        <div class="form-group">
                        <h1>Datos del Hijo </h1>

</div>
</div>

                        <div class="col-sm-4" style="text-align: left;">
                        
                        <div class="form-group">

                        <div class="card" style="width: 18rem;">
                        <img src="{{ asset ($hijo->imagen) }}" class="card-img-top" alt="Imagen de Perfil del empleado">
                        <div class="card-body">
                            <p class="card-text">
                            <strong>Nombre:</strong>
                            {{ $hijo->nombre }} <br>
                            <strong>Cedula:</strong>
                            {{ $hijo->cedula }} <br>
                            <strong>Fecha de Nacimiento:</strong>
                            {{ $hijo->created_at->toDateString() }}<br>
                            <strong>Edad:</strong>
                            {{ $obj_carbon->createFromDate($obj_carbon->parse($hijo->created_at))->age }}<br>
                            <strong>Genero:</strong>
                            {{ $hijo->genero }}<br>
                            <strong>Observacion:</strong>
                            {{ $hijo->observacion }}<br>
                            <strong>Representante:</strong>
                            {{ $hijo->representante->nombre }}<br>
                            <strong>Ced. Representante:</strong>
                            {{ $hijo->representante->cedula }}<br>
                        
                            </p>
                            
                        </div>
                        </div>

                        </div>
                        </div>

                        

                        <div class="col-sm-8" style="text-align: center;">
                        <div class="form-group">

                        <div class="card" style="width: 36rem;">
                        <img src="{{ asset ($hijo->anexocedula) }}" class="card-img-top" alt="Imagen de cedula del hijo">
                        <div class="card-body">
                            <p class="card-text">Imagen de la cédula</p>
                        </div>
                        </div>

                        </div>
                        </div>

                        <!-- Colocar la Partida de Nacimiento -->
                        <div class="col-sm-12" style="text-align: center;">
                            <div class="form-group">

                                <div class="card" style="width: 72rem;">
                                <img src="{{ asset ($hijo->anexopartida ) }}" class="card-img-top" alt="Imagen de la partida de nacimiento">
                                <div class="card-body">
                                    <p class="card-text">Imagen de la Partida de Nacimiento</p>
                                </div>
                                </div>

                            </div>
                        </div>
                        <!-- Fin tarjeta partida de nacimiento -->
                        <!-- Inicio imagen de perfil y cedula del representante -->
                        <div class="col-sm-12" style="text-align: left;">
                        
                        <div class="form-group">
                        <h1>Datos del Representante </h1>

</div>
</div>

                        <div class="col-sm-4" style="text-align: left;">
                        <div class="form-group">

                        <div class="card" style="width: 18rem;">
                        <img src="{{ asset ($hijo->representante->imagen) }}" class="card-img-top" alt="Imagen de Perfil del empleado">
                        <div class="card-body">
                            <p class="card-text">
                            <strong>Nombre:</strong>
                            {{ $hijo->representante->nombre }} <br>
                            <strong>Cedula:</strong>
                            {{ $hijo->representante->cedula }} <br>
                            <strong>Fecha de Nacimiento:</strong>
                            {{ $hijo->representante->created_at->toDateString() }}<br>
                            <strong>Edad:</strong>
                            {{ $obj_carbon->createFromDate($obj_carbon->parse($hijo->representante->created_at))->age }}<br>
                            <strong>Genero:</strong>
                            {{ $hijo->representante->genero }}<br>
                            <strong>Telefono:</strong>
                            {{ $hijo->representante->telefono }}<br>
                            <strong>Tipo:</strong>
                            {{ $hijo->representante->tipo }}<br>
                            <strong>Unidad Administrativa / Ente / Corporacion:</strong>
                            {{ $hijo->representante->unidade->nombre }}<br>
                            <strong>Gabinete:</strong>
                            {{ $hijo->representante->unidade->gabinete->nombre }}
                            </p>
    
  </div>
</div>

                        </div>
                        </div>

                        

                        <div class="col-sm-8" style="text-align: center;">
                        <div class="form-group">

                        <div class="card" style="width: 36rem;">
                        <img src="{{ asset ($hijo->representante->imagencedula) }}" class="card-img-top" alt="Imagen de cedula del empleado">
                        <div class="card-body">
                            <p class="card-text">Imagen de la cédula del representante</p>
                        </div>
                        </div>

                        </div>
                        </div>
                        <!-- Fin de codigo imagen de perfil y cedula del representante -->


                    </div>                        <!-- Fin de Codigo row-->

                        

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
