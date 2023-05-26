@extends('adminlte::page')


@section('title', 'Analisis')

@section('content_header')
    <h1>Reportes Analisis</h1>
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
<form method="POST" action="{{ route('analisis.reporte_pdf') }}"  role="form" enctype="multipart/form-data" class="submit-prevent-form" target="_black">
    @csrf

    <div class="box box-info padding-1">
        <div class="box-body">
    
        <div class="row">

            <div class="col-md-4">    
                <div class="form-group">
                    {{ Form::label('Unidad Administrativa') }}
                    {{ Form::select('unidadadministrativa_id', $unidades, 0, ['class' => 'form-control' . ($errors->has('unidadadministrativa_id') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione una']) }}
                    {!! $errors->first('unidadadministrativa_id', '<div class="invalid-feedback">:message</div>') !!}
                </div>
                </div>

                    <div class="col-md-4">    
                        <div class="form-group">
                            {{ Form::label('Estatus') }}
                            {{ Form::select('status', ['EP'  => 'EN PROCESO', 'PR'  => 'PROCESADO', 'AP'  => 'APROBADO', 'AN'  => 'ANULADO' ], 0, ['class' => 'form-control' . ($errors->has('status') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione un estado']) }}
                            {!! $errors->first('status ', '<div class="invalid-feedback">:message</div>') !!}
                        </div>
                        </div>

                        <div class="col-md-4">    
                            <div class="form-group">
                                {{ Form::label('usuarios') }}
                                {{ Form::select('usuario_id', $usuarios, 0, ['class' => 'form-control' . ($errors->has('usuario_id') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione un usuario']) }}
                                {!! $errors->first('usuario_id ', '<div class="invalid-feedback">:message</div>') !!}
                            </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label('Fecha Inicio') }}
                                    {{ Form::date('fecha_inicio', 0, ['class' => 'form-control' . ($errors->has('fecha_inicio') ? ' is-invalid' : ''), 'placeholder' => 'Fecha']) }}
                                    {!! $errors->first('fecha_inicio', '<div class="invalid-feedback">:message</div>') !!}
                                </div>
                                </div>

                                <div class="col-md-6">
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