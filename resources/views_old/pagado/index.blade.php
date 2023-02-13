@extends('adminlte::page')


@section('title', 'Pagado')

@section('content_header')
    <h1>Pagado</h1>
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
                                {{ __('Pagado') }}
                            </span>

                             <div class="float-right">

                             <a href="{{ route('pagados.agregar') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Crear Nuevo Pagado') }}
                                </a>

                                <a href="{{ route('pagados.index') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('En proceso') }}
                                </a>

                                <a href="{{ route('pagados.procesados') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Procesadas') }}
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
											<td>
                                            @if($pagado->tipoordenpago == 1)
                              CON IMPUTACION 
                            @endif

                            @if($pagado->tipoordenpago == 2)
                             SIN IMPUTACION 
                            @endif
                                            </td>  
                                            <td>{{ $pagado->tipomovimiento->descripcion }}</td>                                         
                                            <td>
                                                @if ($pagado->status == 'EP')
                                                    EN PROCESO
                                                @elseif ($pagado->status == 'PR')
                                                    PROCESADA
                                                @elseif ($pagado->status == 'AP')
                                                    APROBADA
                                                @elseif ($pagado->status == 'AN')
                                                    ANULADA
                                                @endif
                                            </td>
                                            
                                            <td>
                                                <div class="row">

                                                <td>
                                                <form action="{{ route('pagados.aprobar',$pagado->id) }}" method="POST">                                                   
                                                    <a class="btn btn-sm btn-primary " href="{{ route('pagados.show',$pagado->id) }}" data-toggle="tooltip" data-placement="top" title="Mostrar pagado"><i class="fa fa-fw fa-eye"></i></a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('pagados.edit',$pagado->id) }}" data-toggle="tooltip" data-placement="top" title="Editar pagado"><i class="fa fa-fw fa-edit"></i></a>
                                                    {{-- <a class="btn btn-sm btn-danger" href="{{ route('pagados.anular',$pagado->id) }}" data-toggle="tooltip" data-placement="top" title="Anular pagado"><i class="fa fa-fw fa-trash"></i></a> --}}
                                                   @csrf
                                                    @method('PATCH')

                                                    <button type="submit" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="Aprobar pagado"><i class="fas fa-check-double"></i></button>
                                                </form>
                                                <form action="{{ route('pagados.anular',$pagado->id) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Anular pagado"><i class="fa fa-fw fa-trash"></i></button>
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
    @stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop
