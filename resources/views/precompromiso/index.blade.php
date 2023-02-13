@extends('adminlte::page')

@section('title', 'Precompromisos En Proceso')

@section('content_header')
    <h1>Precompromisos En Proceso</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Precompromiso') }}
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
                                        
                                        <th>No. Precompromiso</th>
										<th>Documento</th>
										<th>Monto total</th>
										<th>Concepto</th>
										<th>Unidad administrativa</th>
										<th>Tipo compromiso</th>
										<th>Beneficiario</th>
                                        <th>Estado</th>
                                        <th>Usuario</th>


                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($precompromisos as $precompromiso)

                                    
                                        <tr>
                                          

                                            <td>{{ $precompromiso->id }}</td>
                                            
											<td>{{ $precompromiso->documento }}</td>
											<td>{{ number_format($precompromiso->montototal,2,',','.') }}</td>
											<td>{{ $precompromiso->concepto }}</td>
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
                                                <td>{{ $precompromiso->usuario->name }}</td>

                                            <td>
                                                <form action="{{ route('precompromisos.anular',$precompromiso->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary" href="{{ route('precompromisos.agregar',$precompromiso->id) }}" data-toggle="tooltip" data-placement="top" title="Agregar Detalles"><i class="fas fa-outdent"></i></i> Agregar</a>
                                                      
                                                    <a class="btn btn-sm btn-success" href="{{ route('precompromisos.edit',$precompromiso->id) }}" data-toggle="tooltip" data-placement="top" title="Editar Precompromiso"><i class="fa fa-fw fa-edit"></i> Editar</a>
                                     
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Anular Precompromiso"><i class="fa fa-fw fa-trash"></i> Anular</button>
                                                </form>
                                                <form action="{{ route('precompromisos.aprobar',$precompromiso->id) }}" method="POST">
                                                    
                                                   @csrf
                                                    @method('PATCH')
                                                    
                                                    <button type="submit" class="btn btn-info btn-sm formulario-aprobar" data-name="{{ $precompromiso->documento }}" data-toggle="tooltip" data-placement="top" title="Aprobar Precompromiso"><i class="fas fa-check-double"></i>Aprobar</button>
                                                </form> 

                                                <a class="btn btn-sm btn-primary" href="{{ route('precompromisos.pdf', $precompromiso->id) }}" data-toggle="tooltip" data-placement="top" title="Imprimir Precompromiso" target="_black"><i class="fas fa-print"></i>Imprimir</a>
                                           
                                               


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
    @stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop


