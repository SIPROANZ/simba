@extends('adminlte::page')


@section('title', 'Requisiciones')

@section('content_header')
    <h1>Reportes Requisiciones</h1>
@stop

@section('content')

<section class="content container">
    <div class="row">
        <div class="col-md-12">

            @includeif('partials.errors')

            <div class="card card-default">
                <div class="card-header">
                    <span class="card-title">Seleccione los campos a Buscar</span>
                </div>
                <div class="card-body">
<form method="POST" action="{{ route('requisiciones.reporte_pdf') }}"  role="form" enctype="multipart/form-data" class="submit-prevent-form" target="_black">
    @csrf

    <div class="box box-info padding-1">
        <div class="box-body">
    
        <div class="row">

            <div class="col-md-3">    
                <div class="form-group">
                    {{ Form::label('Institucion') }}
                    {{ Form::select('institucion_id', $instituciones, 0, ['class' => 'form-control' . ($errors->has('institucion_id') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione el instituto']) }}
                    {!! $errors->first('institucion_id', '<div class="invalid-feedback">:message</div>') !!}
                </div>
                </div>

            <div class="col-md-3">    
            <div class="form-group">
                {{ Form::label('Ejercicio') }}
                {{ Form::select('ejercicio_id', $ejercicios, 0, ['class' => 'form-control' . ($errors->has('ejercicio_id') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione el ejercicio']) }}
                {!! $errors->first('ejercicio_id', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            </div>

            <div class="col-md-3">    
                <div class="form-group">
                    {{ Form::label('Unidad Administrativa') }}
                    {{ Form::select('unidadadministrativa_id', $unidades, 0, ['class' => 'form-control' . ($errors->has('unidadadministrativa_id') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione una unidad']) }}
                    {!! $errors->first('unidadadministrativa_id', '<div class="invalid-feedback">:message</div>') !!}
                </div>
                </div>

                <div class="col-md-3">    
                    <div class="form-group">
                        {{ Form::label('Tipo Requisicion') }}
                        {{ Form::select('tiposgp_id', $tipossgps, 0, ['class' => 'form-control' . ($errors->has('tiposgp_id') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione un tipo']) }}
                        {!! $errors->first('tiposgp_id ', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                    </div>

                    <div class="col-md-3">    
                        <div class="form-group">
                            {{ Form::label('Estatus De La Requisicion ') }}
                            {{ Form::select('estatus', ['EP'  => 'EN PROCESO', 'PR'  => 'PROCESADO', 'AP'  => 'APROBADO', 'AN'  => 'ANULADO' ], 0, ['class' => 'form-control' . ($errors->has('estatus') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione un estado']) }}
                            {!! $errors->first('estatus ', '<div class="invalid-feedback">:message</div>') !!}
                        </div>
                        </div>

                        <div class="col-md-3">    
                            <div class="form-group">
                                {{ Form::label('usuarios') }}
                                {{ Form::select('usuario_id', $usuarios, 0, ['class' => 'form-control' . ($errors->has('usuario_id') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione un usuario']) }}
                                {!! $errors->first('usuario_id ', '<div class="invalid-feedback">:message</div>') !!}
                            </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    {{ Form::label('Fecha Inicio') }}
                                    {{ Form::date('fecha_inicio', 0, ['class' => 'form-control' . ($errors->has('fecha_inicio') ? ' is-invalid' : ''), 'placeholder' => 'Fecha']) }}
                                    {!! $errors->first('fecha_inicio', '<div class="invalid-feedback">:message</div>') !!}
                                </div>
                                </div>

                                <div class="col-md-3">
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
            <button type="submit" class="btn btn-primary submit-prevent-button"> Generar Reporte </button>
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