@extends('adminlte::page')


@section('title', 'Pagado')

@section('content_header')
    <h1>Pagado</h1>
@stop

@section('content')
<br>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Pagado') }}
                            </span>

                             <div class="float-right">
                              
                             <a href="{{ route('pagados.agregar') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Crear Nuevo Pagado') }}
                                </a>

                                <a href="{{ route('pagados.index') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('En proceso') }}
                                </a>

                                <a href="{{ route('pagados.procesados') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Procesadas') }}
                                </a>

                                <a href="{{ route('pagados.anulados') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Anuladas') }}
                                </a>

                                <a href="{{ route('pagados.aprobadas') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                    {{ __('Aprobadas') }}
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
                                        
                                        
										<th style="text-align: left"> # Orden de pago</th>
                                        <th style="text-align: left"> # Compromiso</th>
										<th style="text-align: left">Beneficiario</th>
										<th style="text-align: left">Monto Base</th>
										<th style="text-align: left">Monto Retencion</th>
										<th style="text-align: left">Monto Neto</th>
										<th style="text-align: left">IVA</th>
										<th style="text-align: left">Exento</th>
										

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($ordenpagos as $ordenpago)
                                        <tr>
                                            
                                            
											<td style="text-align: left">{{ $ordenpago->nordenpago }}</td>
                                            <td style="text-align: left">{{ $ordenpago->compromiso->ncompromiso }}</td>

											<td style="text-align: left">{{ $ordenpago->beneficiario->nombre }}</td>
											<td style="text-align: left">{{ $ordenpago->montobase }}</td>
											<td style="text-align: left">{{ $ordenpago->montoretencion }}</td>
											<td style="text-align: left">{{ $ordenpago->montoneto }}</td>
											
											<td style="text-align: left">{{ $ordenpago->montoiva }}</td>
											<td style="text-align: left">{{ $ordenpago->montoexento }}</td>

                                            <td>
                                           
                                            <a class="btn btn-sm btn-primary " href="{{ route('pagados.agregarorden',$ordenpago->id) }}" data-toggle="tooltip" data-placement="top" title="Agregar Orden de pago"><i class="fas fa-check"></i></i> Seleccionar</a>
                                                
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $ordenpagos->links() !!}
            </div>
        </div>
    </div>
    @stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

