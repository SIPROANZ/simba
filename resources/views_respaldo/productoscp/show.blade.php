@extends('layouts.app')

@section('template_title')
    {{ $productoscp->name ?? 'Show Productoscp' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Ver Productos Clasificador presupuestario</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('productoscps.index') }}"> Regresar</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Producto:</strong>
                            {{ $productoscp->producto_id }}
                        </div>
                        <div class="form-group">
                            <strong>Clasificador presupuestario:</strong>
                            {{ $productoscp->clasificadorp_id }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
