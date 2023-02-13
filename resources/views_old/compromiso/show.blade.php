@extends('adminlte::page')

@section('title', 'Compromiso')

@section('content_header')
    <h1>Compromiso</h1>
@stop

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Compromiso</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('compromisos.index') }}"> Regresar</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                    <div class="form-group">
                            <strong>Numero de Compromiso:</strong>
                            {{ $compromiso->ncompromiso }}
                        </div>
                        <div class="form-group">
                            <strong>Tipo de compromiso:</strong>
                            {{ $compromiso->tipodecompromiso->nombre}}
                        </div>
                        <div class="form-group">
                            <strong>Numero de Documento:</strong>
                            {{ $compromiso->documento }}
                        </div>
                        <div class="form-group">
                            <strong>Fecha:</strong>
                            {{ $compromiso->created_at }}
                        </div>
                        <div class="form-group">
                            <strong>Concepto:</strong>
                            {{ $concepto }}
                        </div>
                        <div class="form-group">
                            <strong>Beneficiario:</strong>
                            {{ $compromiso->beneficiario->nombre }}
                        </div>
                        <div class="form-group">
                            <strong>Estado:</strong>
                            {{ $status }}
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Agregar las imputaciones relacionadas a este compromiso -->
    <br>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Imputacion Presupuestaria') }}
                            </span>

                             
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        
										<th>Monto Compromiso</th>
										<th>Unidad Administrativa</th>
										<th>Clasificador Presupuestario</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($detallescompromisos as $detallescompromiso)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $detallescompromiso->montocompromiso }}</td>
											<td>{{ $detallescompromiso->unidadadministrativa->unidadejecutora }}</td>
											<td>{{ $detallescompromiso->ejecucione->clasificadorpresupuestario }}</td>

                                           
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $detallescompromisos->links() !!}
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop
