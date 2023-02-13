@extends('adminlte::page')

@section('title', 'Detalles Precompromisos')

@section('content_header')
    <h1>Detalles Precompromisos</h1>
@stop

@section('content')
<br>
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Update Detallescompromiso</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('detallescompromisos.update', $detallescompromiso->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('detallescompromiso.form')

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
