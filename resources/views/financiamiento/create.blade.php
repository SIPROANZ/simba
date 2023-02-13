@extends('adminlte::page')

@section('title', 'Financiamientos')

@section('content_header')
    <h1>Financiamientos</h1>
@stop

@section('content')
<br>
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Crear Financiamiento</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('financiamientos.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('financiamiento.form')

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
