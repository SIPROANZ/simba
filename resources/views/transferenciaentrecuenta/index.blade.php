@extends('adminlte::page')


@section('title', 'Transferencia entre cuentas')

@section('content_header')
    <h1>Transferencia entre cuentas</h1>
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
                                {{ __('Transferencia entre cuenta') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('transferenciaentrecuentas.create') }}" class="btn btn-outline-dark btn-sm float-right"  data-placement="left">
                                  {{ __('Crear nueva transferencia') }}
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
                                  <table class="table table-hover  small table-bordered table-striped">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        
										<th>Monto</th>
										<th>Fecha</th>
										<th>Referencia</th>
										<th>Descripcion</th>
										<th>Banco origen</th>
										<th>Cuenta origen</th>
										<th>Banco destino</th>
										<th>Cuenta destino</th>
                                        <th>Usuario</th>

                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($transferenciaentrecuentas as $transferenciaentrecuenta)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ number_format($transferenciaentrecuenta->monto, 2, ',', '.') }}</td>
											<td>{{ $transferenciaentrecuenta->fecha }}</td>
											<td>{{ $transferenciaentrecuenta->referencia }}</td>
											<td>{!! $transferenciaentrecuenta->descripcion !!}</td>
											<td>{{ $transferenciaentrecuenta->banco->denominacion }}</td>
											<td>{{ $transferenciaentrecuenta->cuentasbancaria->cuenta }}</td>
											<td>{{ $transferenciaentrecuenta->bancodestino->denominacion }}</td>
											<td>{{ $transferenciaentrecuenta->cuentasbancariadestino->cuenta }}</td>
                                            <td>{{ $transferenciaentrecuenta->usuario->name }}</td>

                                            <td>
                                            <a class="btn btn-sm btn-block btn btn-outline-dark btn-block" href="{{ route('transferenciaentrecuentas.pdf',$transferenciaentrecuenta->id) }}" data-toggle="tooltip" data-placement="top" title="Imprimir transferencia entre cuentas" target="_black"><i class="fas fa-print"></i> Imprimir</a>
    
                                            <a class="btn btn-sm btn-block btn btn-outline-dark btn-block" href="{{ route('transferenciaentrecuentas.show',$transferenciaentrecuenta->id) }}"><i class="fas fa-print"></i> Mostrar</a>
                                            <a class="btn btn-sm btn-block btn btn-outline-dark btn-block" href="{{ route('transferenciaentrecuentas.edit',$transferenciaentrecuenta->id) }}"><i class="fa fa-fw fa-edit"></i> Editar!</a>
       
                                            @can('admin.reversar')
                                                <form action="{{ route('transferenciaentrecuentas.destroy',$transferenciaentrecuenta->id) }}" method="POST" class="submit-prevent-form">
                                                @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-outline-danger btn-sm btn-block submit-prevent-button"><i class="fa fa-fw fa-trash"></i> Eliminar</button>
                                                </form>
                                            @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $transferenciaentrecuentas->links() !!}
            </div>
        </div>
    </div>
    @stop

@section('css')

    <link rel="stylesheet" href="/css/admin_custom.css">
@stop
