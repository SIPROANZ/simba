@extends('adminlte::page')

@section('title', 'Compromisos')

@section('content_header')
    <h1>Compromisos</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Compras Por Comprometer.') }}
                            </span>

                             <div class="float-right">
                               
                                <a href="{{ route('compromisos.compras') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Crear Compromiso') }}
                                </a>
                               
                                <a href="{{ route('compromisos.index') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('En Proceso') }}
                                </a>
                                <a href="{{ route('compromisos.procesados') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Procesados') }}
                                </a>
                                <a href="{{ route('compromisos.anulados') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Anulados') }}
                                </a>

                                <a href="{{ route('compromisos.aprobadas') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Aprobados') }}
                                </a>

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
                                       
                                        
										<th>Analisis</th>
                                        <th>Observacion</th>
										<th>Numero de orden compra</th>
										<th>Estado</th>
										<th>Monto Base</th>
										<th>Monto IVA</th>
										<th>Monto Total</th>

                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($compras as $compra)
                                        <tr>
                                            
                                            
											<td>{{ $compra->analisis_id }}</td>
                                            <td>{{ $compra->analisi->observacion }}</td>
											<td>{{ $compra->numordencompra }}</td>
											<td>

                                            @if ($compra->status == 'EP')
                                                    EN PROCESO
                                                @elseif ($compra->status == 'PR')
                                                    PROCESADA
                                                @elseif ($compra->status == 'AP')
                                                    APROBADA
                                                @elseif ($compra->status == 'AN')
                                                    ANULADA
                                                @endif
                                            </td>
											
											<td>{{ $compra->montobase }}</td>
											<td>{{ $compra->montoiva }}</td>
											<td>{{ $compra->montototal }}</td>

                                            <td>
                                            

                                            <a class="btn btn-sm btn-primary " href="{{ route('compromisos.agregarcompromiso',$compra->id) }}" data-toggle="tooltip" data-placement="top" title="Agregar Compromiso"><i class="fas fa-check"></i>Seleccionar</i></a>
                                                
                                            

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $compras->links() !!}
            </div>
        </div>
    </div>

    

<!-- Los precompromisos por comprometer -->
<div class="container-fluid">
    <br><br>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Precompromiso por comprometer') }}
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
                                       
                                        
										<th>Documento</th>
										<th>Montototal</th>
										<th>Concepto</th>
										<th>Unidad administrativa</th>
										<th>Tipo compromiso</th>
										<th>Beneficiario</th>
                                        <th>Estado</th>


                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($precompromisos as $precompromiso)
                                        <tr>
                                            
                                            
											<td>{{ $precompromiso->documento }}</td>
											<td>{{ $precompromiso->montototal }}</td>
											<td>{{ $precompromiso->concepto }}</td>
											<td>{{ $precompromiso->unidadadministrativa->unidadejecutora }}</td>
											<td>{{ $precompromiso->tipodecompromiso->nombre}}</td>
											<td>{{ $precompromiso->beneficiario->nombre }}</td>
                                            <td>
                                           
                                            @if ($precompromiso->status == 'EP')
                                                    EN PROCESO
                                                @elseif ($precompromiso->status == 'PR')
                                                    PROCESADA
                                                @elseif ($precompromiso->status == 'AP')
                                                    APROBADA
                                                @elseif ($precompromiso->status == 'AN')
                                                    ANULADA
                                                @endif

                                            </td>

                                            <td>
                                                
                                            <a class="btn btn-sm btn-primary " href="{{ route('compromisos.agregarprecompromiso',$precompromiso->id) }}" data-toggle="tooltip" data-placement="top" title="Agregar Compromiso Precompromiso"><i class="fas fa-check"></i>Seleccionar</i></a>
                                                
                                            
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $precompromisos->links() !!}
            </div>
        </div>
    </div>

<!-- Ayudas Sociales por Comprometer -->
<div class="container-fluid">
        <br><br>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Ayudas Sociales Por Comprometer') }}
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
                                        
                                        
										<th>Documento</th>
										<th>Monto total</th>
										<th>Concepto</th>
										<th>Unidad administrativa</th>
										<th>Tipo de compromiso</th>
										<th>Beneficiario</th>
                                        <th>Estado</th>

                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($ayudassociales as $ayudassociale)
                                        <tr>
                                            
                                            
											<td>{{ $ayudassociale->documento }}</td>
											<td>{{ $ayudassociale->montototal }}</td>
											<td>{{ $ayudassociale->concepto }}</td>
											<td>{{ $ayudassociale->unidadadministrativa->denominacion }}</td>
											<td>{{ $ayudassociale->tipodecompromiso->nombre }}</td>
											<td>{{ $ayudassociale->beneficiario->nombre }}</td>
                                            <td>
                                            @if ($ayudassociale->status == 'EP')
                                                    EN PROCESO
                                                @elseif ($ayudassociale->status == 'PR')
                                                    PROCESADA
                                                @elseif ($ayudassociale->status == 'AP')
                                                    APROBADA
                                                @elseif ($ayudassociale->status == 'AN')
                                                    ANULADA
                                                @endif
                                            </td>

                                            <td>

                                            <a class="btn btn-sm btn-primary " href="{{ route('compromisos.agregarayuda',$ayudassociale->id) }}" data-toggle="tooltip" data-placement="top" title="Agregar Compromiso Ayuda"><i class="fas fa-check"></i>Seleccionar</i></a>
                                                
                                               
                                               
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $ayudassociales->links() !!}
            </div>
        </div>
    </div>

    @stop 

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop