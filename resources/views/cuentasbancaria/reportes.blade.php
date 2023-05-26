@extends('adminlte::page')


@section('title', 'Estado Financiero Bancario')

@section('content_header')
    <h1>Reportes Estado Financiero Banco</h1>
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
<form method="POST" action="{{ route('cuentasbancarias.reporte_pdf') }}"  role="form" enctype="multipart/form-data" class="submit-prevent-form" target="_black">
    @csrf

    <div class="box box-info padding-1">
        <div class="box-body">
    
        <div class="row">

            <div class="col-md-6">    
                <div class="form-group">
                    {{ Form::label('Bancos') }}
                    {{ Form::select('banco', $bancos, 0, ['class' => 'form-control' . ($errors->has('banco') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione un banco']) }}
                    {!! $errors->first('banco', '<div class="invalid-feedback">:message</div>') !!}
                </div>
                </div>

                <div class="col-md-6">    
                    <div class="form-group">
                        {{ Form::label('Cuenta Bancaria') }}
                        {{ Form::select('cuenta', $cuentas, 0, ['class' => 'form-control' . ($errors->has('cuenta') ? ' is-invalid' : ''), 'placeholder' => 'Seleccione una cuenta']) }}
                        {!! $errors->first('cuenta', '<div class="invalid-feedback">:message</div>') !!}
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