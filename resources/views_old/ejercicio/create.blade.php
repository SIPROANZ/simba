@extends('adminlte::page')

@section('title', 'Ejercicio Fiscal')

@section('content_header')
    <h1>Ejercicio Fiscal</h1>
@stop

@section('content')
<br>
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Crear Ejercicio</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('ejercicios.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('ejercicio.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop
