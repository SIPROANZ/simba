@extends('adminlte::page')


@section('title', 'Ordenes de Compras')

@section('content_header')
    <h1>Ordenes de Compras</h1>
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
                                {{ __('Compras En Proceso') }}
                            </span>

                             <div class="float-right">
                               

                                 <a href="{{ route('compras.analisis') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Crear Orden de Compra') }}
                                </a>


                                <a href="{{ route('compras.index') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Compras en Proceso') }}
                                </a>

                                <a href="{{ route('compras.procesadas') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Compras Procesadas') }}
                                </a>

                                <a href="{{ route('compras.anuladas')  }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Compras Anuladas') }}
                                </a>

                                <a href="{{ route('compras.aprobadas')  }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Compras Aprobadas') }}
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
                                        
										<th>Analisis</th>
                                        <th>Observacion</th>
										<th>Numero de orden compra</th>
										<th>Estado</th>
										<th>Anulacion</th>
										<th>Monto Base</th>
										<th>Monto IVA</th>
										<th>Monto Total</th>

                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($compras as $compra)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $compra->analisis_id }}</td>
                                            <td>{{ $compra->analisi->observacion }}</td>
											<td>{{ $compra->numordencompra }}</td>
											<td>
                                                

                                            @if ($compra->status == 'EP')
                                                    EN PROCESO
                                                @elseif ($compra->status == 'PR')
                                                    PROCESADA
                                                @elseif ($compra->status == 'AP')
                                                    APROBADA
                                                @elseif ($compra->status == 'AN')
                                                    ANULADA
                                                @endif


                                            </td>
											<td>{{ $compra->fechaanulacion }}</td>
											<td>{{ $compra->montobase }}</td>
											<td>{{ $compra->montoiva }}</td>
											<td>{{ $compra->montototal }}</td>

                                            <td>
                                            <form action="{{ route('compras.aprobar',$compra->id) }}" method="POST">
                                                    <!-- Agregar detalles BOS a la requisicion -->
                                                    <a class="btn btn-sm btn-info " href="{{ route('compras.show',$compra->id) }}" data-toggle="tooltip" data-placement="top" title="Mostrar Compra"><i class="fa fa-fw fa-eye"></i></a>
                                                    
                                                    <a class="btn btn-sm btn-primary " href="{{ route('compras.pdf',$compra->id) }}" data-toggle="tooltip" data-placement="top" title="Imprimir Compra"><i class="fa fa-fw fa-print"></i></a>
                                                   
                                                   @csrf
                                                    @method('PATCH')
                                                    
                                                    <button type="submit" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="Aprobar Compra"><i class="fas fa-check-double"></i></button>
                                                </form>

                                                <form action="{{ route('compras.anular',$compra->id) }}" method="POST">
                                                  
                                                   <a class="btn btn-sm btn-success" href="{{ route('compras.edit',$compra->id) }}" data-toggle="tooltip" data-placement="top" title="Editar Compra"><i class="fa fa-fw fa-edit"></i></a>
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Anular Compra"><i class="fa fa-fw fa-trash"></i></button>
                                                </form>

                                                <form action="{{ route('compras.actualizar',$compra->id) }}" method="POST">
                                                    <!-- Agregar detalles BOS a la requisicion -->
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Actualizar Compra"><i class="fas fa-history"></i></button>
                                                </form>

                                                
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $compras->links() !!}
            </div>
        </div>
    </div>
    @stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop
