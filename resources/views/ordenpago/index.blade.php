@extends('adminlte::page')


@section('title', 'Orden de Pago')

@section('content_header')
    <h1>Orden de Pago</h1>
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
                                {{ __('Ordenes de Pago') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('ordenpagos.compromisos') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Crear Orden de Pago') }}
                                </a>
                                <a href="{{ route('ordenpagos.index') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                {{ __('En Proceso') }}
                                </a>
                                <a href="{{ route('ordenpagos.procesados') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                {{ __('Procesados') }}
                                </a>
                                <a href="{{ route('ordenpagos.aprobados') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                {{ __('Aprobados') }}
                                </a>
                                <a href="{{ route('ordenpagos.anulados') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                {{ __('Anulados') }}
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
                    <form method="GET">
<div class="input-group mb-3">
  <input type="text" name="search" class="form-control" placeholder="Buscar">
  <button class="btn btn-outline-primary" type="submit" id="button-addon2">Buscar</button>
</div>
</form>


                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                       
                                    
										<th class="col-md-1" style="text-align: left">N° Orden de pago</th>
										<th class="col-md-1" style="text-align: left">Numero Compromiso</th>
										<th class="col-md-4" style="text-align: left">Beneficiario</th>{{--
										<th style="text-align: left">Monto base</th>
                                        
										<th style="text-align: left">Monto retencion</th> --}}
                                        <th style="text-align: left">Monto base</th>
                                        <th style="text-align: left">Monto retencion</th>
                                        <th style="text-align: left">Monto IVA</th>
										<th class="col-md-2" style="text-align: left">Monto neto</th>{{--
										<th style="text-align: left">Fecha anulacion</th> --}}
										<th class="col-md-1.5" style="text-align: left">Estado</th>
                                        <th class="col-md-1.5" style="text-align: center">usuario</th>
                                        
                                        {{--
										<th style="text-align: left">Tipo orden</th>
										<th style="text-align: left">Monto IVA</th>
										<th style="text-align: left">Monto exento</th> --}}

                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($ordenpagos as $ordenpago)
                                        <tr>
                                            

											<td style="text-align: left">{{ $ordenpago->nordenpago }}</td>
											<td style="text-align: left">{{ $ordenpago->compromiso->ncompromiso }}</td>
											<td style="text-align: left">{{ $ordenpago->beneficiario->nombre }}</td>{{--
											<td style="text-align: left">{{ $ordenpago->montobase }}</td>
											<td style="text-align: left">{{ $ordenpago->montoretencion }}</td> --}}


											<td style="text-align: left">{{ number_format($ordenpago->montobase, 2,',','.') }}</td>
                                            <td style="text-align: left">{{ number_format($ordenpago->montoretencion, 2,',','.') }}</td>
                                            <td style="text-align: left">{{ number_format($ordenpago->montoiva, 2,',','.') }}</td> 
                                            
                                            
                                            <th style="text-align: left">{{ number_format($ordenpago->montoneto, 2,',','.') }}</th>
                                            
                                            {{--
											<td style="text-align: left">{{ $ordenpago->fechaanulacion }}</td> --}}
											<td style="text-align: left">
                                                @if ($ordenpago->status == 'EP')
                                                    En Proceso
                                                @elseif ($ordenpago->status == 'PR')
                                                    Procesada
                                                @elseif ($ordenpago->status == 'AP')
                                                    Aprobada
                                                @elseif ($ordenpago->status == 'AN')
                                                    Anulada
                                                @endif
                                            </td>
                                            <td style="text-align: left">{{ $ordenpago->usuario->name }}</td>
                                           {{--
											<td style="text-align: left">{{ $ordenpago->tipoorden }}</td>
											<td style="text-align: left">{{ $ordenpago->montoiva }}</td>
											<td style="text-align: left">{{ $ordenpago->montoexento }}</td> --}}

                                            <td>
                                                <form action="{{ route('ordenpagos.aprobar',$ordenpago->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('ordenpagos.agregar',$ordenpago->id) }}" data-toggle="tooltip" data-placement="top" title="Agregar Retenciones"><i class="fas fa-plus"></i></i> Retencion</a>
                                                    <a class="btn btn-sm btn-info " href="{{ route('ordenpagos.show',$ordenpago->id) }}" data-toggle="tooltip" data-placement="top" title="Mostrar Orden de Pago"><i class="fa fa-fw fa-eye"></i> Mostrar</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('ordenpagos.edit',$ordenpago->id) }}" data-toggle="tooltip" data-placement="top" title="Editar Orden de Pago"><i class="fa fa-fw fa-edit"></i> Editar</a>
                                                    <a class="btn btn-sm btn-dark " href="{{ route('ordenpagos.pdf',$ordenpago->id) }}" data-toggle="tooltip" data-placement="top" title="Imprimir Orden de Pago" target="_black"><i class="fas fa-print"></i> Imprimir</a>
                                                    <a class="btn btn-sm btn-success " href="{{ route('ordenpagos.agregarfacturas',$ordenpago->id) }}" data-toggle="tooltip" data-placement="top" title="Agregar Facturas"><i class="fas fa-check"></i></i> Facturas</a>
                                                    
                                                    {{-- <a class="btn btn-sm btn-danger" href="{{ route('ordenpagos.anular',$ordenpago->id) }}" data-toggle="tooltip" data-placement="top" title="Anular Orden de pago"><i class="fa fa-fw fa-trash"></i></a> --}}
                                                   @csrf
                                                    @method('PATCH')

                                                    <button type="submit" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="Aprobar orden de pago"><i class="fas fa-check-double"></i> Aprobar</button>
                                                </form>
                                               <form action="{{ route('ordenpagos.anular',$ordenpago->id) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Anular Orden de pago"><i class="fa fa-fw fa-trash"></i> Anular</button>
                                                </form> 
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
