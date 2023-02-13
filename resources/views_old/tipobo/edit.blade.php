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
                        <form method="POST" action="{{ route('tipobos.update', $tipobo->id) }}"  role="form" enctype="multipart/form-data">
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
        <link rel="stylesheet" href="/css/admin_custom.css">
    @stop
