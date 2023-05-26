@extends('adminlte::page')

@section('title', 'Ejecucion')

@section('content_header')
    <h1>Ejecucion</h1>
@stop

@section('content')
<br>
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Actualizar Ejecución</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('ejecuciones.update', $ejecucione->id) }}"  role="form" enctype="multipart/form-data" class="submit-prevent-form">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('ejecucione.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @stop

@section('css')
<meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop
