@extends('layouts.app')

@section('template_title')
    Pagado
@endsection

@section('content')
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

                             <a href="{{ route('transferencias.miagregar') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Crear Transferencia') }}
                                </a>

                                <a href="{{ route('transferencias.index') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('En Proceso') }}
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
                                        
										<th>Orden de pago</th>
										<th>Beneficiario</th>{{--                                       
										<th>Monto pagado</th>
                                        <th>Correlativo</th>
										<th>Fechaanulacion</th> --}}									
										<th>Tipo de orden</th>  
                                        <th>Tipo de Pago</th>                                      
                                        <th>Estado</th>
                                     
                                        <th>Monto a pagar</th>
                                        <th>Monto pagado</th>
                                        <th>Monto por pagar</th>

                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pagados as $pagado)

                                    @if(($pagado->ordenpago->montoneto - $pagado->montopagado)>0)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $pagado->ordenpago_id }}</td>
											<td>{{ $pagado->beneficiario->nombre }}</td>{{--                                            
											<td>{{ $pagado->montopagado }}</td>
                                            <td>{{ $pagado->correlativo }}</td>
											<td>{{ $pagado->fechaanulacion }}</td> --}}											
											<td>{{ $pagado->tipoordenpago }}</td>  
                                            <td>{{ $pagado->tipomovimiento->descripcion }}</td>                                         
                                            <td>
                                                @if ($pagado->status == 'EP')
                                                    EP
                                                @elseif ($pagado->status == 'PR')
                                                    PR
                                                @elseif ($pagado->status == 'AP')
                                                    AP
                                                @elseif ($pagado->status == 'AN')
                                                    AN
                                                @endif
                                            </td>
                                            <td>{{ $pagado->ordenpago->montoneto }}</td>
                                            <td>{{ $pagado->montopagado }}</td>
                                            <?php $total = $pagado->ordenpago->montoneto - $pagado->montopagado; ?>
                                            <td>{{ $total   }}</td>
                                            
                                            
                                                <div class="row">

                                                <td>
                                            
                                                <a class="btn btn-sm btn-primary " href="{{ route('transferencias.seleccionarpagado',$pagado->id) }}" data-toggle="tooltip" data-placement="top" title="Agregar Pagado"><i class="fas fa-outdent"></i></i></a>
                                             
                                               
                                            </td>

                                                </div>

                                        </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $pagados->links() !!}
            </div>
        </div>
    </div>
@endsection