@extends('adminlte::page')


@section('title', 'AJUSTES COMPROMISOS')

@section('content_header')
    <h1>AJUSTES COMPROMISOS</h1>
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
                                {{ __('Ajustes Procesados') }}
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
                                        
                                        
										<th>Tipo</th>
										<th>No. Compromiso</th>
										<th>Documento</th>
										<th>Concepto</th>
										<th>Monto ajuste</th>
                                        <th>Estado</th>
                                        <th>Usuario</th>

                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($ajustescompromisos as $ajustescompromiso)
                                        <tr>
                                            
                                            
											<td>
                                            @if ($ajustescompromiso->tipo == 1)
                                                    AUMENTA
                                                @elseif ($ajustescompromiso->tipo == 2)
                                                    DISMINUYE
                                                @endif
                                            </td>
											<td>{{ $ajustescompromiso->compromiso->ncompromiso }}</td>
											<td>{{ $ajustescompromiso->documento }}</td>
											<td>{{ $ajustescompromiso->concepto }}</td>
											<td>{{ number_format($ajustescompromiso->montoajuste,2,',','.') }}</td>
                                            <td>
                                            @if ($ajustescompromiso->status == 'EP')
                                                    EN PROCESO
                                                @elseif ($ajustescompromiso->status == 'PR')
                                                    PROCESADA
                                                @elseif ($ajustescompromiso->status == 'AP')
                                                    APROBADA
                                                @elseif ($ajustescompromiso->status == 'AN')
                                                    ANULADA
                                                @endif
                                            </td>

                                            <td>{{ $ajustescompromiso->usuario->name }}</td>
                                            <td>
                                                
                                            <a class="btn btn-sm btn-primary " href="{{ route('ajustescompromisos.pdf',$ajustescompromiso->id) }}" data-toggle="tooltip" data-placement="top" title="Imprimir Ajuste Compromiso"><i class="fas fa-print"></i> Imprimir</a>

                                            <form action="{{ route('ajustescompromisos.reversar',$ajustescompromiso->id) }}" method="POST">
                                                    <!-- Agregar detalles BOS a la requisicion -->
                                                    
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Reversar Ajuste de Compromiso"><i class="fa fa-fw fa-check"></i> Reversar</button>
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
    @stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop
