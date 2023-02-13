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
                        
                    <div class="row">
        <div class="col-md-3">
                        <div class="form-group">
                            <strong>Ejercicio:</strong>
                            {{ $ejecucione->ejercicio->ejercicioejecucion }}
                        </div>
                        </div>

                        <div class="col-md-3">
                        <div class="form-group">
                            <strong>Institucion:</strong>
                            {{ $ejecucione->institucione->institucion }}
                        </div>
                        </div>

                        <div class="col-md-3">
                        <div class="form-group">
                            <strong>Unidadadministrativa:</strong>
                            {{ $ejecucione->unidadadministrativa->unidadejecutora }}
                        </div>
                        </div>

                       

                        <div class="col-md-3">
                        <div class="form-group">
                            <strong>Clasificador presupuestario:</strong>
                            {{ $ejecucione->clasificadorpresupuestario }}
                        </div>
                        </div>

                        

                        <div class="col-md-3">
                        <div class="form-group">
                            <strong>Monto Inicial:</strong>
                            {{ number_format($ejecucione->monto_inicial,2,',','.') }}
                        </div>
                        </div>

                        <div class="col-md-3">
                        <div class="form-group">
                            <strong>Monto Aumento:</strong>
                            {{ number_format($ejecucione->monto_aumento,2,',','.') }}
                        </div>
                        </div>

                        <div class="col-md-3">
                        <div class="form-group">
                            <strong>Monto Disminuye:</strong>
                            {{ number_format($ejecucione->monto_disminuye,2,',','.') }}
                        </div>
                        </div>

                        <div class="col-md-3">
                        <div class="form-group">
                            <strong>Monto Actualizado:</strong>
                            {{ number_format($ejecucione->monto_actualizado,2,',','.') }}
                        </div>
                        </div>

                        <div class="col-md-3">
                        <div class="form-group">
                            <strong>Monto Precomprometido:</strong>
                            {{ number_format($ejecucione->monto_precomprometido,2,',','.') }}
                        </div>
                        </div>

                        <div class="col-md-3">
                        <div class="form-group">
                            <strong>Monto Comprometido:</strong>
                            {{ number_format($ejecucione->monto_comprometido,2,',','.') }}
                        </div>
                        </div>

                        <div class="col-md-3">
                        <div class="form-group">
                            <strong>Monto Causado:</strong>
                            {{ number_format($ejecucione->monto_causado,2,',','.') }}
                        </div>
                        </div>

                        <div class="col-md-3">
                        <div class="form-group">
                            <strong>Monto Pagado:</strong>
                            {{ number_format($ejecucione->monto_pagado,2,',','.') }}
                        </div>
                        </div>

                        <div class="col-md-3">
                        <div class="form-group">
                            <strong>Monto Disponible:</strong>
                            {{ number_format($ejecucione->monto_por_comprometer,2,',','.') }}
                        </div>
                        </div>

                        <div class="col-md-3">
                        <div class="form-group">
                            <strong>Monto Por Causar:</strong>
                            {{ number_format($ejecucione->monto_por_causar,2,',','.') }}
                        </div>
                        </div>


                        <div class="col-md-3">
                        <div class="form-group">
                            <strong>Monto Por Pagar:</strong>
                            {{ number_format($ejecucione->monto_por_pagar,2,',','.') }}
                        </div>

                        </div>

                        <div class="col-md-3">
                        <div class="form-group">
                            <strong>usuario:</strong>
                            {{ $ejecucione->usuario->name }}
                        </div>

                        </div>
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
                                        
										
										<th>Compromiso</th>
										<th>Unidad administrativa</th>
										<th>Ejecucion</th>
                                        <th>Estado</th>
                                        <th>Monto compromiso</th>

                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($detallescompromisos as $detallescompromiso)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											
											<td>{{ $detallescompromiso->compromiso->ncompromiso }}</td>
											<td>{{ $detallescompromiso->unidadadministrativa->unidadejecutora }}</td>
											<td>{{ $detallescompromiso->ejecucion_id }}</td>
                                            <td>{{ $detallescompromiso->compromiso->status }}</td>
                                            <td>{{ number_format($detallescompromiso->montocompromiso,2,',','.') }}</td>

                                            
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
                                        
										<th>Orden pago</th>
										<th>Unidad administrativa</th>
										<th>Ejecucion</th>
										<th>Monto</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($detalleordenpagos as $detalleordenpago)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $detalleordenpago->ordenpago->nordenpago }}</td>
											<td>{{ $detalleordenpago->unidadadministrativa->unidadejecutora}}</td>
											<td>{{ $detalleordenpago->ejecucion_id }}</td>
											<td>{{ number_format($detalleordenpago->monto,2,',','.') }}</td>

                                            
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
                                        
										<th>Pagado</th>
										<th>Orden pago</th>
										<th>Unidad administrativa</th>
										<th>Ejecucion</th>
										<th>Monto pagado</th>

                                      
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($detallepagados as $detallepagado)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $detallepagado->pagado_id }}</td>
											<td>{{ $detallepagado->ordenpago->nordenpago }}</td>
											<td>{{ $detallepagado->unidadadministrativa->unidadejecutora }}</td>
											<td>{{ $detallepagado->ejecucion_id }}</td>
											<td>{{ number_format($detallepagado->montopagado,2,',','.') }}</td>

                                            
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
                                        
										<th>Modificacion</th>
										<th>Unidad administrativa</th>
										<th>Ejecucion</th>
										<th>Monto acredita</th>
										<th>Monto debita</th>

                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($detallesmodificaciones as $detallesmodificacione)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $detallesmodificacione->modificacione->numero }}</td>
											<td>{{ $detallesmodificacione->unidadadministrativa->unidadejecutora }}</td>
											<td>{{ $detallesmodificacione->ejecucion_id }}</td>
											<td>{{ number_format($detallesmodificacione->montoacredita,2,',','.') }}</td>
											<td>{{ number_format($detallesmodificacione->montodebita,2,',','.') }}</td>

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
