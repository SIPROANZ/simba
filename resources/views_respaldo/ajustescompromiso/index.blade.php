@extends('adminlte::page')

@section('template_title')
    Ajustescompromiso
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
                                {{ __('Ajustar Compromisos') }}
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
                                        
										<th>Tipo</th>
										<th>Compromiso Id</th>
										<th>Documento</th>
										<th>Concepto</th>
										<th>Monto ajuste</th>
                                        <th>Estado</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($ajustescompromisos as $ajustescompromiso)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $ajustescompromiso->tipo }}</td>
											<td>{{ $ajustescompromiso->compromiso_id }}</td>
											<td>{{ $ajustescompromiso->documento }}</td>
											<td>{{ $ajustescompromiso->concepto }}</td>
											<td>{{ $ajustescompromiso->montoajuste }}</td>
                                            <td>{{ $ajustescompromiso->status }}</td>

                                            <td>
                                                
                                            <form action="{{ route('ajustescompromisos.aprobar',$ajustescompromiso->id) }}" method="POST">
                                                    <!-- Agregar detalles BOS a la requisicion -->
                                                    <a class="btn btn-sm btn-primary " href="{{ route('ajustescompromisos.pdf',$ajustescompromiso->id) }}" data-toggle="tooltip" data-placement="top" title="Imprimir Ajuste Compromiso"><i class="fas fa-print"></i></a>

                                                
                                                    <a class="btn btn-sm btn-primary " href="{{ route('ajustescompromisos.show',$ajustescompromiso->id) }}" data-toggle="tooltip" data-placement="top" title="Mostrar Ajuste Compromiso"><i class="fa fa-fw fa-eye"></i></a>
                                                   
                                                   @csrf
                                                    @method('PATCH')
                                                    
                                                    <button type="submit" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="Aprobar Ajuste Compromiso"><i class="fas fa-check-double"></i></button>
                                                </form>

                                                <form action="{{ route('ajustescompromisos.anular',$ajustescompromiso->id) }}" method="POST">
                                                  
                                                <a class="btn btn-sm btn-success" href="{{ route('ajustescompromisos.edit',$ajustescompromiso->id) }}" data-toggle="tooltip" data-placement="top" title="Editar Ajuste Compromiso"><i class="fa fa-fw fa-edit"></i></a>
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Anular Ajuste Compromiso"><i class="fa fa-fw fa-trash"></i></button>
                                                </form>

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $ajustescompromisos->links() !!}
            </div>
        </div>
    </div>
@endsection
