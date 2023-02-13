@@extends('adminlte::page')

@section('title', 'Requisiciones')

@section('content_header')
    <h1>Detalles Requisiciones</h1>
@stop

@section('content')
<br>
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Detallesrequisicione</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('detallesrequisiciones.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Requisicion Id:</strong>
                            {{ $detallesrequisicione->requisicion_id }}
                        </div>
                        <div class="form-group">
                            <strong>Bos Id:</strong>
                            {{ $detallesrequisicione->bos_id }}
                        </div>
                        <div class="form-group">
                            <strong>Cantidad:</strong>
                            {{ $detallesrequisicione->cantidad }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    @stop
    
    @section('css')
    
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop
