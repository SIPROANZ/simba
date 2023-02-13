@extends('adminlte::page')

@section('title', 'Ayudas Sociales Anuladas')

@section('content_header')
    <h1>Ayudas Sociales Anuladas</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Ayudas Sociales Anuladas') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('ayudassociales.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Crear Nueva Ayuda Social') }}
                                </a>
                                <a href="{{ route('ayudassociales.aprobadas') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Aprobadas') }}
                                </a>
                                <a href="{{ route('ayudassociales.index') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('En Proceso') }}
                                </a>
                                <a href="{{ route('ayudassociales.procesadas') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Procesadas') }}
                                </a>
                                <a href="{{ route('ayudassociales.anuladas') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Anuladas') }}
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
                                        <th>No</th>
                                        
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
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $ayudassociale->documento }}</td>
											<td style="text-align: right">{{ number_format($ayudassociale->montototal,2,',','.') }}</td>
											<td>{{ $ayudassociale->concepto }}</td>
											<td>{{ $ayudassociale->unidadadministrativa->denominacion }}</td>
											<td>{{ $ayudassociale->tipodecompromiso->nombre }}</td>
											<td>{{ $ayudassociale->beneficiario->nombre }}</td>
                                            <td> @if ($ayudassociale->status == 'EP')
                                                    EN PROCESO
                                                @elseif ($ayudassociale->status == 'PR')
                                                    PROCESADA
                                                @elseif ($ayudassociale->status == 'AP')
                                                    APROBADA
                                                @elseif ($ayudassociale->status == 'AN')
                                                    ANULADA
                                                @endif</td>

                                            <td>
                                               
                                            <a class="btn btn-sm btn-primary " href="{{ route('ayudassociales.pdf',$ayudassociale->id) }}" data-toggle="tooltip" data-placement="top" title="Imprimir Ayuda Social"><i class="fas fa-print"></i></a>
                                           
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