@extends('adminlte::page')

@section('title', 'Objetivos Estrategicos')

@section('content_header')
    <h1>Objetivos Estrategicos</h1>
@stop

@section('content')
<br>
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Crear Objetivos Estrategicos</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('objetivosestrategicos.store') }}"  role="form" enctype="multipart/form-data" class="submit-prevent-form">
                            @csrf

                            @include('objetivosestrategico.form')

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
    <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                $('.ckeditor').ckeditor();
            });
        </script>
    
    
    @stop
