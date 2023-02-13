@extends('adminlte::page')

@section('title', 'Objetivos Municipales')

@section('content_header')
    <h1>Objetivos Municipales</h1>
@stop

@section('content')
<br>
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Update Objetivomunicipale</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('objetivomunicipales.update', $objetivomunicipale->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('objetivomunicipale.form')

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
