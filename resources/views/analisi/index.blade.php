@extends('adminlte::page')


@section('title', 'Analisis de Cotizacion')

@section('content_header')
    <h1>Analisis de Cotizacion</h1>
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
                                {{ __('Analisis de Cotizaciones en Proceso') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('analisis.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Crear Nuevo Analisis de Cotizacion') }}
                                </a>

                                <a href="{{ route('analisis.aprobadas') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Aprobadas') }}
                                </a>

                                <a href="{{ route('analisis.index') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('En Proceso') }}
                                </a>

                                <a href="{{ route('analisis.procesadas') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Procesadas') }}
                                </a>

                                <a href="{{ route('analisis.anuladas')  }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                       
                                    <th>No. Analisis</th>
                                        
										<th>Unidad administrativa</th>
										<th>Numero Requisicion</th>
										<th>Criterio</th>
										<th>Numero Cotizacion</th>
										<th>Observacion</th>
                                        <th>Estatus</th>
                                        <th>Usuario</th>

                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($analisis as $analisi)
                                        <tr>
                                            <td>{{ $analisi->id }}</td>
                                            
											<td>{{ $analisi->unidadadministrativa->unidadejecutora }}</td>
											<td>{{ $analisi->requisicione->correlativo }}</td>
											<td>{{ $analisi->criterio->nombre }}</td>
											<td>{{ $analisi->numeracion }}</td>
											<td>{{ $analisi->observacion }}</td>
                                            <td>

                                            @if ($analisi->estatus == 'EP')
                                                    EN PROCESO
                                                @elseif ($analisi->estatus == 'PR')
                                                    PROCESADA
                                                @elseif ($analisi->estatus == 'AP')
                                                    APROBADA
                                                @elseif ($analisi->estatus == 'AN')
                                                    ANULADA
                                                @endif

                                            </td>

                                            <td>{{ $analisi->usuario->name }}</td>

                                            <td>
                                                
                                                <form action="{{ route('analisis.anular',$analisi->id) }}" method="POST">
                                                    <!-- Agregar detalles BOS a la requisicion -->
                                                    <a class="btn btn-sm btn-primary " href="{{ route('analisis.agregar',$analisi->id) }}" data-toggle="tooltip" data-placement="top" title="Agregar Productos al analisis"><i class="fas fa-outdent"></i></i> Agregar</a>
                                                    
                                                    <a class="btn btn-sm btn-success" href="{{ route('analisis.edit',$analisi->id) }}" data-toggle="tooltip" data-placement="top" title="Editar Analisis"><i class="fa fa-fw fa-edit"></i> Editar</a>
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Anular Analisis"><i class="fa fa-fw fa-trash"></i> Anular</button>
                                                </form>

                                                <form action="{{ route('analisis.aprobar',$analisi->id) }}" method="POST">
                                                    <!-- Agregar detalles BOS a la requisicion -->
                                                   @csrf
                                                    @method('PATCH')
                                                    
                                                    <button type="submit" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="Aprobar Analisis"><i class="fas fa-check-double"></i> Aprobar</button>
                                                </form>

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $analisis->links() !!}
            </div>
        </div>
    </div>
@endsection
