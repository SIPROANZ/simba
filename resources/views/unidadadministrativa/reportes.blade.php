@extends('adminlte::page')


@section('title', 'Unidad Administrativa')

@section('content_header')
    <h1>Reporte Unidad Administrativa</h1>
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
<form method="POST" action="{{ route('unidadadministrativas.reporte_pdf') }}"  role="form" enctype="multipart/form-data" class="submit-prevent-form" target="_black">
    @csrf

    <div class="box box-info padding-1">
        <div class="box-body">
    
        <div class="row">

            
                        <div class="col-md-4">    
                            <div class="form-group">
                                {{ Form::label('Unidad Administrativa') }}
                                {{ Form::text('unidad', '', ['class' => 'form-control' . ($errors->has('unidad') ? ' is-invalid' : ''), 'placeholder' => 'Ingrese unidad a buscar']) }}
                                {!! $errors->first('unidad ', '<div class="invalid-feedback">:message</div>') !!}
                            </div>
                            </div>

                            <div class="col-md-4">    
                                <div class="form-group">
                                    {{ Form::label('Instituciones') }}
                                    {{ Form::select('institucion', $instituciones, 0, ['class' => 'form-control' . ($errors->has('institucion') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione uno']) }}
                                    {!! $errors->first('institucion ', '<div class="invalid-feedback">:message</div>') !!}
                                </div>
                                </div>

                                <div class="col-md-4">    
                                    <div class="form-group">
                                        {{ Form::label('Usuarios') }}
                                        {{ Form::select('usuario', $usuarios, 0, ['class' => 'form-control' . ($errors->has('usuario') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione uno']) }}
                                        {!! $errors->first('usuario ', '<div class="invalid-feedback">:message</div>') !!}
                                    </div>
                                    </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    {{ Form::label('Fecha Inicio') }}
                                    {{ Form::date('fecha_inicio', 0, ['class' => 'form-control' . ($errors->has('fecha_inicio') ? ' is-invalid' : ''), 'placeholder' => 'Fecha']) }}
                                    {!! $errors->first('fecha_inicio', '<div class="invalid-feedback">:message</div>') !!}
                                </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        {{ Form::label('Fecha Fin') }}
                                        {{ Form::date('fecha_fin', 0, ['class' => 'form-control' . ($errors->has('fecha_fin') ? ' is-invalid' : ''), 'placeholder' => 'Fecha']) }}
                                        {!! $errors->first('fecha_fin', '<div class="invalid-feedback">:message</div>') !!}
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