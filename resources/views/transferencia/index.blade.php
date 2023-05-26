@extends('adminlte::page')

@section('title', 'Transferencias')

@section('content_header')
    <h1>Transferencias </h1>
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
                                {{ __('') }}
                            </span>

                             <div class="float-right">
{{--
                               <a href="{{ route('transferencias.miagregar') }}" class="btn btn-outline-dark btn-sm float-right"  data-placement="left">
                                  {{ __('Crear Transferencia') }}
                                </a>

                                <a href="{{ route('transferencias.index') }}" class="btn btn-outline-dark btn-sm float-right"  data-placement="left">
                                  {{ __('En Proceso') }}
                                </a>



                                <a href="{{ route('transferencias.anulados') }}" class="btn btn-outline-dark btn-sm float-right"  data-placement="left">
                                  {{ __('Anuladas') }}
                                </a>

                                --}}

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
                                  <table class="table table-hover  small table-bordered table-striped">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>

                                        <th>Banco</th>
										<th>Cuentas bancaria</th>
                                        <th>Beneficiario</th>
										<th>Monto Pagado</th>
										<th>Monto transferencia</th>
										<th>Concepto</th>
										<th>Egreso</th>
										<th>Monto orden</th>
										<th>Referencia</th>
                                        <th>Usuario</th>

                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($transferencias as $transferencia)
                                        <tr>
                                            <td>{{ ++$i }}</td>

                                            <td>{{ $transferencia->cuentasbancaria->banco->denominacion}}</td>
											<td>{{ $transferencia->cuentasbancaria->cuenta }}</td>
											<td>{{ $transferencia->beneficiario->nombre }}</td>
											<td>{{ number_format($transferencia->pagado->montopagado, 2,',','.') }}</td>
											<td>{{ number_format($transferencia->montotransferencia, 2,',','.') }}</td>
											<td>{{ $transferencia->concepto }}</td>
											<td>{{ $transferencia->egreso }}</td>
											<td>{{ number_format($transferencia->pagado->ordenpago->montoneto, 2,',','.') }}</td>
											<td>{{ $transferencia->referenciabancaria }}</td>

                                            <td>{{ $transferencia->usuario->name }}</td>
                                           


                                            <td>

                                            <a class="btn btn-sm btn-block btn btn-outline-dark btn-block" href="{{ route('transferencias.pdf',$transferencia->id) }}" data-toggle="tooltip" data-placement="top" title="Imprimir transferencias" target="_black"><i class="fas fa-print"></i> Imprimir</a>

                                            @can('admin.reversar')
                                            <a class="btn btn-sm btn-block btn btn-outline-success btn-block " href="{{ route('transferencias.reversar',$transferencia->id) }}" data-toggle="tooltip" data-placement="top" title="Reversar la transferencia"><i class="fas fa-check"></i> Reversar</a>
                                            @endcan
                                        </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $transferencias->links() !!}
            </div>
        </div>
    </div>
    @stop

 @section('css')
    
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous"/>
    <link rel="stylesheet" href="{{ asset('css/submit.css') }}">
        
    @stop
    
    @section('js')
    <script src="{{ asset('js/submit.js') }}"></script>
    
    
    @stop
