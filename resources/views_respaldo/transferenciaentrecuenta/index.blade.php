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
                                <a href="{{ route('transferenciaentrecuentas.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
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

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($transferenciaentrecuentas as $transferenciaentrecuenta)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $transferenciaentrecuenta->monto }}</td>
											<td>{{ $transferenciaentrecuenta->fecha }}</td>
											<td>{{ $transferenciaentrecuenta->referencia }}</td>
											<td>{{ $transferenciaentrecuenta->descripcion }}</td>
											<td>{{ $transferenciaentrecuenta->banco->denominacion }}</td>
											<td>{{ $transferenciaentrecuenta->cuentasbancarias->cuenta }}</td>
											<td>{{ $transferenciaentrecuenta->bancodestino->denominacion }}</td>
											<td>{{ $transferenciaentrecuenta->cuentasbancariadestino->cuenta }}</td>

                                            <td>
                                                <form action="{{ route('transferenciaentrecuentas.destroy',$transferenciaentrecuenta->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('transferenciaentrecuentas.show',$transferenciaentrecuenta->id) }}"><i class="fa fa-fw fa-eye"></i> Mostrar</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('transferenciaentrecuentas.edit',$transferenciaentrecuenta->id) }}"><i class="fa fa-fw fa-edit"></i> Editar</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> Eliminar</button>
                                                </form>
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
