@extends('adminlte::page')

@section('title', 'Facturas')

@section('content_header')
    <h1>Facturas</h1>
@stop

@section('content')
<br>
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Agregar Factura</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('facturas.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('factura.form')

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
