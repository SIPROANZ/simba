@extends('adminlte::page')

@section('title', 'Objetivos Municipales')

@section('content_header')
    <h1>Objetivos Municipales</h1>
@stop

@section('content')
<br>
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Objetivomunicipale</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('objetivomunicipales.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="form-group">
                            <strong>Objetivomunicipal:</strong>
                            {{ $objetivomunicipale->objetivomunicipal }}
                        </div>
                        <div class="form-group">
                            <strong>Objetivo:</strong>
                            {{ $objetivomunicipale->objetivo }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
