@extends('adminlte::page')

@section('template_title')
    Compromiso
@endsection

@section('content')
<br>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Compromisos') }}
                            </span>

                             <div class="float-right">
                             <a href="{{ route('ajustescompromisos.agregar') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Crear Nuevo Ajuste') }}
                                </a>

                                <a href="{{ route('ajustescompromisos.index') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('En Proceso') }}
                                </a>

                                <a href="{{ route('ajustescompromisos.procesadas') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Procesados') }}
                                </a>

                                <a href="{{ route('ajustescompromisos.anuladas') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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

                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($compromisos as $compromiso)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $compromiso->unidadadministrativa->denominacion }}</td>
											<td>{{ $compromiso->tipodecompromiso->nombre }}</td>
											<td>{{ $compromiso->ncompromiso }}</td>
											<td>{{ $compromiso->beneficiario->nombre }}</td>
											<td>{{ $compromiso->montocompromiso }}</td>
											<td>{{ $compromiso->status }}</td>
											<td>{{ $compromiso->documento }}</td>
											<td>{{ $compromiso->fechaanulacion }}</td>
											<td>{{ $compromiso->precompromiso_id }}</td>
											<td>{{ $compromiso->compra_id }}</td>
											<td>{{ $compromiso->ayuda_id }}</td>

                                            <td>
                                        
                                            <a class="btn btn-sm btn-primary " href="{{ route('ajustescompromisos.agregarcompromiso',$compromiso->id) }}" data-toggle="tooltip" data-placement="top" title="Agregar Ajuste Compromiso"><i class="fas fa-outdent"></i></i></a>
                                                
                                    
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
@endsection