@extends('adminlte::page')

@section('title', 'Ejecucion')

@section('content_header')
    <h1>Ejecucion</h1>
@stop

@section('content')
<br>
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Mostrar Ejecución</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('ejecuciones.index') }}"> Volver</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Ejercicio Id:</strong>
                            {{ $ejecucione->ejercicio_id }}
                        </div>
                        <div class="form-group">
                            <strong>Institucion Id:</strong>
                            {{ $ejecucione->institucion_id }}
                        </div>
                        <div class="form-group">
                            <strong>Unidadadministrativa Id:</strong>
                            {{ $ejecucione->unidadadministrativa_id }}
                        </div>
                        <div class="form-group">
                            <strong>Meta Id:</strong>
                            {{ $ejecucione->meta_id }}
                        </div>
                        <div class="form-group">
                            <strong>Clasificadorpresupuestario:</strong>
                            {{ $ejecucione->clasificadorpresupuestario }}
                        </div>
                        <div class="form-group">
                            <strong>Financiamiento Id:</strong>
                            {{ $ejecucione->financiamiento_id }}
                        </div>
                        <div class="form-group">
                            <strong>Monto Inicial:</strong>
                            {{ $ejecucione->monto_inicial }}
                        </div>
                        <div class="form-group">
                            <strong>Monto Aumento:</strong>
                            {{ $ejecucione->monto_aumento }}
                        </div>
                        <div class="form-group">
                            <strong>Monto Disminuye:</strong>
                            {{ $ejecucione->monto_disminuye }}
                        </div>
                        <div class="form-group">
                            <strong>Monto Actualizado:</strong>
                            {{ $ejecucione->monto_actualizado }}
                        </div>
                        <div class="form-group">
                            <strong>Monto Precomprometido:</strong>
                            {{ $ejecucione->monto_precomprometido }}
                        </div>
                        <div class="form-group">
                            <strong>Monto Comprometido:</strong>
                            {{ $ejecucione->monto_comprometido }}
                        </div>
                        <div class="form-group">
                            <strong>Monto Causado:</strong>
                            {{ $ejecucione->monto_causado }}
                        </div>
                        <div class="form-group">
                            <strong>Monto Pagado:</strong>
                            {{ $ejecucione->monto_pagado }}
                        </div>
                        <div class="form-group">
                            <strong>Monto Por Comprometer:</strong>
                            {{ $ejecucione->monto_por_comprometer }}
                        </div>
                        <div class="form-group">
                            <strong>Monto Por Causar:</strong>
                            {{ $ejecucione->monto_por_causar }}
                        </div>
                        <div class="form-group">
                            <strong>Monto Por Pagar:</strong>
                            {{ $ejecucione->monto_por_pagar }}
                        </div>
                        <div class="form-group">
                            <strong>Poa Id:</strong>
                            {{ $ejecucione->poa_id }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Detalles del Compromiso con respecto a esta partida en especifica -->
    <br><br>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('COMPROMISOS') }}
                            </span>

                             <div class="float-right">
                                
                              </div>
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
                                        
										<th>Montocompromiso</th>
										<th>Compromiso Id</th>
										<th>Unidadadministrativa Id</th>
										<th>Ejecucion Id</th>
                                        <th>Estado</th>

                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($detallescompromisos as $detallescompromiso)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $detallescompromiso->montocompromiso }}</td>
											<td>{{ $detallescompromiso->compromiso_id }}</td>
											<td>{{ $detallescompromiso->unidadadministrativa_id }}</td>
											<td>{{ $detallescompromiso->ejecucion_id }}</td>
                                            <td>{{ $detallescompromiso->compromiso->status }}</td>

                                            
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

    <!-- Detalles del Causado con respecto a esta partida en especifica -->
    <br><br>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('CAUSADOS') }}
                            </span>

                             <div class="float-right">
                               
                              </div>
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
                                        
										<th>Ordenpago Id</th>
										<th>Unidadadministrativa Id</th>
										<th>Ejecucion Id</th>
										<th>Monto</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($detalleordenpagos as $detalleordenpago)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $detalleordenpago->ordenpago_id }}</td>
											<td>{{ $detalleordenpago->unidadadministrativa_id }}</td>
											<td>{{ $detalleordenpago->ejecucion_id }}</td>
											<td>{{ $detalleordenpago->monto }}</td>

                                            
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $detalleordenpagos->links() !!}
            </div>
        </div>
    </div>

    <!-- Detalles del Pagado con respecto a esta partida en especifica -->
    <br><br>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('PAGADOS') }}
                            </span>

                             <div class="float-right">
                            
                              </div>
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
                                        
										<th>Pagado Id</th>
										<th>Ordenpago Id</th>
										<th>Unidadadministrativa Id</th>
										<th>Ejecucion Id</th>
										<th>Montopagado</th>

                                      
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($detallepagados as $detallepagado)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $detallepagado->pagado_id }}</td>
											<td>{{ $detallepagado->ordenpago_id }}</td>
											<td>{{ $detallepagado->unidadadministrativa_id }}</td>
											<td>{{ $detallepagado->ejecucion_id }}</td>
											<td>{{ $detallepagado->montopagado }}</td>

                                            
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $detallepagados->links() !!}
            </div>
        </div>
    </div>

    <!-- Detalles Modificaciones Presupuestarias -->
    <br><br>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('MODIFICACIONES') }}
                            </span>

                             <div class="float-right">
                               
                              </div>
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
                                        
										<th>Modificacion Id</th>
										<th>Unidadadministrativa Id</th>
										<th>Ejecucion Id</th>
										<th>Montoacredita</th>
										<th>Montodebita</th>

                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($detallesmodificaciones as $detallesmodificacione)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $detallesmodificacione->modificacion_id }}</td>
											<td>{{ $detallesmodificacione->unidadadministrativa_id }}</td>
											<td>{{ $detallesmodificacione->ejecucion_id }}</td>
											<td>{{ $detallesmodificacione->montoacredita }}</td>
											<td>{{ $detallesmodificacione->montodebita }}</td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $detallesmodificaciones->links() !!}
            </div>
        </div>
    </div>
    @stop

@section('css')
<meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop
