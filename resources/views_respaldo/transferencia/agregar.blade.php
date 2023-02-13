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

                                <a href="{{ route('pagados.anulados') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                     

                                        <th></th>

                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pagados as $pagado)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $pagado->ordenpago_id }}</td>
											<td>{{ $pagado->beneficiario->nombre }}</td>{{--                                            
											<td>{{ $pagado->montopagado }}</td>
                                            <td>{{ $pagado->correlativo }}</td>
											<td>{{ $pagado->fechaanulacion }}</td> --}}											
											<td>{{ $pagado->tipoordenpago }}</td>  
                                            <td>{{ $pagado->tipomovimiento->descripcion }}</td>                                         
                                            <td>{{ $pagado->status }}</td>
                                            
                                            <td>
                                                <div class="row">

                                                <td>   
                                                <form action="{{ route('transferencias.aprobar',$transferencia->id) }}" method="POST">                                                   
                                                   
                                                    <a class="btn btn-sm btn-primary " href="{{ route('transferencias.show',$transferencia->id) }}" data-toggle="tooltip" data-placement="top" title="Mostrar transferencias"><i class="fa fa-fw fa-eye"></i></a>
                                                   
                                                   @csrf
                                                    @method('PATCH')

                                                    <button type="submit" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="Aprobar transferencias"><i class="fas fa-check-double"></i></button>
                                                </form>
                                               
                                            </td>


                                               </div>

                                            </td>
                                        </tr>
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
