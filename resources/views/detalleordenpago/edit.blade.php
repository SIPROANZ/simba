@extends('adminlte::page')

@section('title', 'Detalle orden de pago')

@section('content_header')
    <h1>Detalle orden de pago</h1>
@stop

@section('content')
<br>
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Update Detalleordenpago</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('detalleordenpagos.update', $detalleordenpago->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('detalleordenpago.form')

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
