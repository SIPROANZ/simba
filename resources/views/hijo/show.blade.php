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
                        
                        <div class="form-group">
                            <strong>Nombre:</strong>
                            {{ $hijo->nombre }}
                        </div>
                        <div class="form-group">
                            <strong>Cedula:</strong>
                            {{ $hijo->cedula }}
                        </div>
                        <div class="form-group">
                            <strong>Genero:</strong>
                            {{ $hijo->genero }}
                        </div>
                        <div class="form-group">
                            <strong>Anexocedula:</strong>
                            {{ $hijo->anexocedula }}
                        </div>
                        <div class="form-group">
                            <strong>Anexopartida:</strong>
                            {{ $hijo->anexopartida }}
                        </div>
                        <div class="form-group">
                            <strong>Cedularepresentante:</strong>
                            {{ $hijo->cedularepresentante }}
                        </div>
                        <div class="form-group">
                            <strong>Observacion:</strong>
                            {{ $hijo->observacion }}
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
