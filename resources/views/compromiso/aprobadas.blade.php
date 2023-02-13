@extends('adminlte::page')

@section('title', 'Compromisos')

@section('content_header')
    <h1>Compromisos Aprobados</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Compromisos Aprobados') }}
                            </span>

                             <div class="float-right">
                             <a href="{{ route('compromisos.compras') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Crear Compromiso') }}
                                </a>
                                
                                <a href="{{ route('compromisos.index') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('En Proceso') }}
                                </a>
                                <a href="{{ route('compromisos.procesados') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Procesados') }}
                                </a>
                                <a href="{{ route('compromisos.anulados') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Anulados') }}
                                </a>

                                <a href="{{ route('compromisos.aprobadas') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Aprobados') }}
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
                                    <th>Numero compromiso</th>
                                        
										<th>Unidad Administrativa</th>
										<th>Tipo compromiso</th>
										<th>Beneficiario</th>
										<th>Monto compromiso</th>
										<th>Estado</th>
										<th>Documento</th>
										
										<th>Control</th>

                                        <th>Usuario</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($compromisos as $compromiso)
                                        <tr>
                                            <td>{{ $compromiso->ncompromiso }}</td>
                                            
											<td>{{ $compromiso->unidadadministrativa->unidadejecutora }}</td>
											<td>{{ $compromiso->tipodecompromiso->nombre }}</td>
											<td>{{ $compromiso->beneficiario->nombre }}</td>
                                            <td>{{ number_format($compromiso->montocompromiso,2,',','.') }}</td>
											<td>
                                                
                                                @if ($compromiso->status == 'EP')
                                                    EN PROCESO
                                                @elseif ($compromiso->status == 'PR')
                                                    PROCESADA
                                                @elseif ($compromiso->status == 'AP')
                                                    APROBADA
                                                @elseif ($compromiso->status == 'AN')
                                                    ANULADA
                                                @endif


                                            </td>
											<td>{{ $compromiso->documento }}</td>
											<td>
                                            @if($compromiso->precompromiso_id != NULL)
                                                {{ 'PRE-' . $compromiso->precompromiso_id }}
                                                @endif
                                                @if($compromiso->compra_id != NULL)
                                                {{ 'BOS-' . $compromiso->compra_id }}
                                                @endif
                                                @if($compromiso->ayuda_id != NULL)
                                                {{ 'AYD-' .$compromiso->ayuda_id }}
                                                @endif
                                            </td>

                                            <td>{{ $compromiso->usuario->name }}</td>

                                            <td>
                                           
                                            <a class="btn btn-sm btn-primary " href="{{ route('compromisos.pdf',$compromiso->id) }}" data-toggle="tooltip" data-placement="top" title="Imprimir Compromiso"><i class="fas fa-print"></i> Imprimir</a>
  
                                            <!--
                                            <form action="{{ route('compromisos.modificar',$compromiso->id) }}" method="POST">
                                            <a class="btn btn-sm btn-primary " href="{{ route('compromisos.pdf',$compromiso->id) }}" data-toggle="tooltip" data-placement="top" title="Imprimir Compromiso"><i class="fas fa-print"></i></a>
                                            @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Modificar Compromiso"><i class="fa fa-fw fa-check"></i></button>
                                                </form> -->

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
    @stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop