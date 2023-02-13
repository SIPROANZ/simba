@extends('adminlte::page')

@section('title', 'Compromisos')

@section('content_header')
    <h1> Editar Compromisos </h1>
@stop

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Editar Compromiso</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('compromisos.update', $compromiso->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('compromiso.formedit')

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
