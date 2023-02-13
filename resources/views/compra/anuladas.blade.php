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
                                {{ __('Compras Anuladas') }}
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
                                        <th>Numero Compra</th>
										<th>Numero Analisis</th>
                                        <th>Observacion</th>
										
										<th>Estado</th>
										<th>Anulacion</th>
										<th>Monto Base</th>
										<th>Monto IVA</th>
										<th>Monto Total</th>

                                        <th>Usuario</th>

                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($compras as $compra)
                                        <tr>
                                        <td>{{ $compra->numordencompra }}</td>
                                            
											<td>{{ $compra->analisis_id }}</td>
                                            <td>{{ $compra->analisi->observacion }}</td>
											
											<td> @if ($compra->status == 'EP')
                                                    EN PROCESO
                                                @elseif ($compra->status == 'PR')
                                                    PROCESADA
                                                @elseif ($compra->status == 'AP')
                                                    APROBADA
                                                @elseif ($compra->status == 'AN')
                                                    ANULADA
                                                @endif</td>
											<td>{{ $compra->fechaanulacion }}</td>
											<td>{{ number_format($compra->montobase, 2, ',', '.') }}</td>
											<td>{{ number_format($compra->montoiva, 2, ',', '.') }}</td>
											<td>{{ number_format($compra->montototal, 2, ',', '.') }}</td>

                                            <td>{{ $compra->usuario->name }}</td>

                                            <td>
                                           
                                            <a class="btn btn-sm btn-primary " href="{{ route('compras.pdf',$compra->id) }}" data-toggle="tooltip" data-placement="top" title="Imprimir Compra"><i class="fa fa-fw fa-print"></i> Imprimir</a>
                                           
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