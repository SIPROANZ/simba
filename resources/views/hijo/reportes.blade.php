@extends('adminlte::page')


@section('title', 'Hijo')

@section('content_header')
    <h1>Reportes de Hijos</h1>
@stop

@section('content')

<section class="content container">
    <div class="row">
        <div class="col-md-12">

            @includeif('partials.errors')

            <div class="card card-default">
                <div class="card-header">
                    <span class="card-title">Seleccione los campos a buscar</span>
                </div>
                <div class="card-body">
<form method="POST" action="{{ route('hijos.reporte_pdf') }}"  role="form" enctype="multipart/form-data" class="submit-prevent-form" target="_black">
    @csrf

    <div class="box box-info padding-1">
        <div class="box-body">
    
        <div class="row">

                <div class="col-md-3">    
                <div class="form-group">
                    {{ Form::label('Nombre del Hijo') }}
                    {{ Form::text('nombre', '', ['class' => 'form-control' . ($errors->has('nombre') ? ' is-invalid' : ''), 'placeholder' => 'Ingrese Nombre']) }}
                    {!! $errors->first('nombre', '<div class="invalid-feedback">:message</div>') !!}
                </div>
                </div>

                <div class="col-md-3">    
                <div class="form-group">
                    {{ Form::label('Nombre del Representante') }}
                    {{ Form::text('nombre_representante', '', ['class' => 'form-control' . ($errors->has('nombre_representante') ? ' is-invalid' : ''), 'placeholder' => 'Ingrese Nombre']) }}
                    {!! $errors->first('nombre_representante', '<div class="invalid-feedback">:message</div>') !!}
                </div>
                </div>

                <div class="col-md-3">    
                <div class="form-group">
                    {{ Form::label('Cedula del Representante') }}
                    {{ Form::text('cedula', '', ['class' => 'form-control' . ($errors->has('cedula') ? ' is-invalid' : ''), 'placeholder' => 'Ingrese Cedula']) }}
                    {!! $errors->first('cedula', '<div class="invalid-feedback">:message</div>') !!}
                </div>
                </div>


                    <div class="col-md-3">    
                        <div class="form-group">
                            {{ Form::label('Genero') }}
                            {{ Form::select('genero', ['MASCULINO'  => 'MASCULINO', 'FEMENINO'  => 'FEMENINO'], 0, ['class' => 'form-control' . ($errors->has('genero') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione uno']) }}
                            {!! $errors->first('genero', '<div class="invalid-feedback">:message</div>') !!}
                        </div>
                        </div>

                        <div class="col-md-3">    
                        <div class="form-group">
                            {{ Form::label('Tipo') }}
                            {{ Form::select('tipo', ['EMPLEADO'  => 'EMPLEADO', 'JUBILADO'  => 'JUBILADO', 'INACTIVO'  => 'INACTIVO'], 0, ['class' => 'form-control' . ($errors->has('tipo') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione uno']) }}
                            {!! $errors->first('tipo', '<div class="invalid-feedback">:message</div>') !!}
                        </div>
                        </div>

                        <div class="col-md-3">    
                            <div class="form-group">
                                {{ Form::label('Pertenece a') }}
                                {{ Form::select('unidad', $unidades, 0, ['class' => 'form-control' . ($errors->has('unidad') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione uno']) }}
                                {!! $errors->first('unidad', '<div class="invalid-feedback">:message</div>') !!}
                            </div>
                            </div>

                            <div class="col-md-3">    
                            <div class="form-group">
                                {{ Form::label('Gabinete') }}
                                {{ Form::select('gabinete', $gabinetes, 0, ['class' => 'form-control' . ($errors->has('gabinete') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione uno']) }}
                                {!! $errors->first('gabinete', '<div class="invalid-feedback">:message</div>') !!}
                            </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    {{ Form::label('Fecha Inicio - Rango Edad') }}
                                    {{ Form::date('fecha_inicio', 0, ['class' => 'form-control' . ($errors->has('fecha_inicio') ? ' is-invalid' : ''), 'placeholder' => 'Fecha']) }}
                                    {!! $errors->first('fecha_inicio', '<div class="invalid-feedback">:message</div>') !!}
                                </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        {{ Form::label('Fecha Fin - Rango Edad') }}
                                        {{ Form::date('fecha_fin', 0, ['class' => 'form-control' . ($errors->has('fecha_fin') ? ' is-invalid' : ''), 'placeholder' => 'Fecha']) }}
                                        {!! $errors->first('fecha_fin', '<div class="invalid-feedback">:message</div>') !!}
                                    </div>
                                    </div>

                          <div class="col-md-3">    
                        <div class="form-group">
                            {{ Form::label('Imagen') }}
                            {{ Form::select('imagen', ['CON IMAGEN'  => 'CON IMAGEN', 'SIN IMAGEN'  => 'SIN IMAGEN'], 0, ['class' => 'form-control' . ($errors->has('imagen') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione uno']) }}
                            {!! $errors->first('imagen', '<div class="invalid-feedback">:message</div>') !!}
                        </div>
                        </div>


            </div>
    
        </div>
    
        <br>
    
        <div class="box-footer mt20">
            <button type="submit" class="btn btn-primary submit-prevent-button"> Generar </button>
        </div>
    </div>

</form>    
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



@stop