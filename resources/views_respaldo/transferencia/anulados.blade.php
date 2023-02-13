@extends('layouts.app')

@section('template_title')
    Transferencia
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Transferencia') }}
                            </span>

                             <div class="float-right">

                               <a href="{{ route('transferencias.agregartransferencia') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Crear Transferencia') }}
                                </a>

                                <a href="{{ route('transferencias.agregar') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('En Proceso') }}
                                </a>

                                <a href="{{ route('transferencias.index') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Emitidas') }}
                                </a>

                                <a href="{{ route('transferencias.anulados') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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

                                        <th>Beneficiario Id</th>{{--
										<th>Cuentasbancaria Id</th>										
										<th>Monto Pagado</th>
										<th>Monto transferencia</th>
										<th>Fecha</th>
										<th>Concepto</th>
										<th>Egreso</th>
										<th>Monto orden</th>
										<th>Referencia </th>
										<th>Concepto</th>
                                        <th></th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($transferencias as $transferencia)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $transferencia->cuentasbancaria_id }}</td>
											<td>{{ $transferencia->beneficiario->nombre }}</td>{{--
											<td>{{ $transferencia->pagado->montopagado }}</td>
											<td>{{ $transferencia->montotransferencia }}</td>
											<td>{{ $transferencia->fechaanulacion }}</td>
											<td>{{ $transferencia->concepto }}</td>
											<td>{{ $transferencia->egreso }}</td>
											<td>{{ $transferencia->montoorden }}</td>
											<td>{{ $transferencia->referenciabancaria }}</td>
											<td>{{ $transferencia->conceptoanulacion }}</td>
                                            <td>
                                                @if ($transferencia->status == 'EP')
                                                    EP
                                                @elseif ($transferencia->status == 'PR')
                                                    PR
                                                @elseif ($transferencia->status == 'AP')
                                                    AP
                                                @elseif ($transferencia->status == 'AN')
                                                    AN
                                                @endif
                                            </td>
                                            <td>

                                            <a class="btn btn-sm btn-primary " href="{{ route('transferencias.pdf',$transferencia->id) }}" data-toggle="tooltip" data-placement="top" title="Imprimir transferencias"><i class="fas fa-print"></i></a>
                                            
                                        </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $transferencias->links() !!}
            </div>
        </div>
    </div>
@endsection
