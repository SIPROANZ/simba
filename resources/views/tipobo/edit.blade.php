@extends('adminlte::page')

@section('title', 'Tipos de BOS')

@section('content_header')
    <h1>Tipos de BOS</h1>
@stop

@section('content')
<br>
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-8">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Editar Tipo BOS</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('tipobos.update', $tipobo->id) }}"  role="form" enctype="multipart/form-data" class="submit-prevent-form">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('tipobo.form')

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
    <script src="{{ asset('js/submit.js') }}"></script>
    
    
    @stop
