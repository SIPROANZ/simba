@extends('adminlte::page')


@section('title', 'Modificaciones')

@section('content_header')
    <h1>Modificaciones</h1>
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
                                {{ __('Modificaciones Presupuestarias') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('modificaciones.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Crear Modificacion') }}
                                </a>
                                <a href="{{ route('modificaciones.index') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('En Proceso') }}
                                </a>
                                <a href="{{ route('modificaciones.procesadas') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Procesadas') }}
                                </a>
                                <a href="{{ route('modificaciones.anuladas') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                        
                                        
										<th>No Modificacion</th>
										<th>Tipo modificacion</th>
										<th>Descripcion</th>
										<th>Status</th> 
										<th>Monto credita</th>
										<th>Monto debita</th>
										<th>Numero Credito</th>
                                        <th>usuario</th>

                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($modificaciones as $modificacione)
                                        <tr>
                                          
                                            
											<td>{{ $modificacione->numero }}</td>
											<td>{{ $modificacione->tipomodificacione->nombre }}</td>
											<td>{{ $modificacione->descripcion }}</td>
											<td>@if ($modificacione->status == 'EP')
                                                    EN PROCESO
                                                @elseif ($modificacione->status == 'PR')
                                                    PROCESADA
                                                @elseif ($modificacione->status == 'AP')
                                                    APROBADA
                                                @elseif ($modificacione->status == 'AN')
                                                    ANULADA
                                                @endif</td>
											
											<td>{{ number_format($modificacione->montocredita,2,',' ,'.') }}</td>
											<td>{{ number_format($modificacione->montodebita,2,',' ,'.') }}</td>
											<td>{{ $modificacione->ncredito }}</td>

                                            <td>{{ $modificacione->usuario->name }}</td>

                                            <td>
                        
                                                <form action="{{ route('modificaciones.anular',$modificacione->id) }}" method="POST">
                                                <a class="btn btn-sm btn-primary " href="{{ route('modificaciones.agregarmodificacion',$modificacione->id) }}" data-toggle="tooltip" data-placement="top" title="Agregar Detalle"><i class="fas fa-outdent"></i></i> Agregar</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('modificaciones.edit',$modificacione->id) }}" data-toggle="tooltip" data-placement="top" title="Editar Ajuste"><i class="fa fa-fw fa-edit"></i> Editar</a>
                                                   
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Anular Modificacion"><i class="fa fa-fw fa-trash"></i> Anular</button>
                                                </form>

                                                <form action="{{ route('modificaciones.aprobar',$modificacione->id) }}" method="POST">
                                                    <!-- Agregar detalles BOS a la requisicion -->
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="Aprobar Modificacion"><i class="fas fa-check-double"></i> Aprobar</button>
                                                </form>

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $modificaciones->links() !!}
            </div>
        </div>
    </div>
    @stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop
