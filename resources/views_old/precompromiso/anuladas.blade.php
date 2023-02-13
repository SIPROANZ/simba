@extends('adminlte::page')

@section('title', 'Precompromisos Anulados')

@section('content_header')
    <h1>Precompromisos Anulados</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Precompromisos Anulados') }}
                            </span>

                             <div class="float-right">
                             <a href="{{ route('precompromisos.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Crear Nuevo Precompromiso') }}
                                </a>
                                <a href="{{ route('precompromisos.aprobadas') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Aprobadas') }}
                                </a>
                                <a href="{{ route('precompromisos.index') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('En Proceso') }}
                                </a>
                                <a href="{{ route('precompromisos.procesadas') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Procesadas') }}
                                </a>
                                <a href="{{ route('precompromisos.anuladas') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
										<th>Fecha anulacion</th>
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
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $precompromiso->documento }}</td>
											<td>{{ number_format($precompromiso->montototal,2,',','.') }}</td>
											
											<td>{{ $precompromiso->concepto }}</td>
											<td>{{ $precompromiso->fechaanulacion }}</td>
											<td>{{ $precompromiso->unidadadministrativa->unidadejecutora }}</td>
											<td>{{ $precompromiso->tipodecompromiso->nombre}}</td>
											<td>{{ $precompromiso->beneficiario->nombre }}</td>
                                            <td>@if ($precompromiso->status == 'EP')
                                                    EN PROCESO
                                                @elseif ($precompromiso->status == 'PR')
                                                    PROCESADA
                                                @elseif ($precompromiso->status == 'AP')
                                                    APROBADA
                                                @elseif ($precompromiso->status == 'AN')
                                                    ANULADA
                                                @endif</td>

                                            <td>
                                                
                                            <a class="btn btn-sm btn-primary " href="{{ route('precompromisos.pdf',$precompromiso->id) }}" data-toggle="tooltip" data-placement="top" title="Imprimir Precompromiso"><i class="fas fa-print"></i></a>

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
@endsection
