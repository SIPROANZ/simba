@extends('adminlte::page')

@section('title', 'Objetivos Municipales')

@section('content_header')
    <h1>Ver Objetivos Municipales</h1>
@stop

@section('content')
<br>
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title"></span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('objetivomunicipales.index') }}"> Regresar</a>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="form-group">
                            <strong>Numeral:</strong>
                            {{ $objetivomunicipale->objetivomunicipal }}
                        </div>
                        <div class="form-group">
                            <strong>Objetivo:</strong>
                            {!!$objetivomunicipale->objetivo !!}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
