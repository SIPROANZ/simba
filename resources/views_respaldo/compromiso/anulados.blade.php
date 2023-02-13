@extends('adminlte::page')

@section('title', 'Compromisos')

@section('content_header')
    <h1>Compromisos Anulados</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Compromisos Anulados') }}
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
                                        <th>No</th>
                                        
										<th>Unidad Administrativa</th>
										<th>Tipo compromiso</th>
										<th>Numero compromiso</th>
										<th>Beneficiario</th>
										<th>Monto compromiso</th>
										<th>Estado</th>
										<th>Documento</th>
										<th>Fecha Anulacion</th>
										<th>Precompromiso</th>
										<th>Compra</th>
										<th>Ayuda</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($compromisos as $compromiso)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $compromiso->unidadadministrativa->unidadejecutora }}</td>
											<td>{{ $compromiso->tipodecompromiso->nombre }}</td>
											<td>{{ $compromiso->ncompromiso }}</td>
											<td>{{ $compromiso->beneficiario->nombre }}</td>
											<td>{{ $compromiso->montocompromiso }}</td>
											<td>
                                                
                                            @if ($compromiso->status == 'EP')
                                                    EN PROCESO
                                                @elseif ($compromiso->status == 'PR')
                                                    PROCESADA
                                                @elseif ($compromiso->status == 'AP')
                                                    APROBADA
                                                @elseif ($compromiso->status == 'AN')
                                                    ANULADA
                                                @endif
                                                
                                            </td>
											<td>{{ $compromiso->documento }}</td>
											<td>{{ $compromiso->fechaanulacion }}</td>
											<td>{{ $compromiso->precompromiso_id }}</td>
											<td>{{ $compromiso->compra_id }}</td>
											<td>{{ $compromiso->ayuda_id }}</td>

                                            <td>
                                            <a class="btn btn-sm btn-primary " href="{{ route('compromisos.pdf',$compromiso->id) }}" data-toggle="tooltip" data-placement="top" title="Imprimir Compromiso"><i class="fas fa-print"></i></a>

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $compromisos->links() !!}
            </div>
        </div>
    </div>
    @stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop