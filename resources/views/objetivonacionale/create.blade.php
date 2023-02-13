@extends('adminlte::page')

@section('title', 'Objetivos Nacionales')

@section('content_header')
    <h1>Objetivos Nacionales</h1>
@stop

@section('content')
<br>

    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Crear Objetivo Nacional</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('objetivonacionales.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('objetivonacionale.form')

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
