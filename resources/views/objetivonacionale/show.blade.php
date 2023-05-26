@extends('adminlte::page')

@section('title', 'Objetivos Nacionales')

@section('content_header')
    <h1>Ver Objetivos Nacionales</h1>
@stop

@section('content')
<br>
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title"></span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('objetivonacionales.index') }}"> Regresar</a>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="form-group">
                            <strong>numeral:</strong>
                            {{ $objetivonacionale->objetivonacional }}
                        </div>
                        <div class="form-group">
                            <strong>Objetivo Nacional:</strong>
                            {!!$objetivonacionale->objetivo !!}
                        </div>
                        <div class="form-group">
                            <strong>Objetivo Historico:</strong>
                            {!! $objetivonacionale->objetivoshistorico->objetivo !!}
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
