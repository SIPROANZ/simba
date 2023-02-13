@extends('adminlte::page')


@section('title', 'Analisis de Cotizaciones')

@section('content_header')
    <h1>Analisis</h1>
@stop

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Analisis de cotizacion</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('detallesanalisis.storedos') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('detallesanalisi.form2')

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