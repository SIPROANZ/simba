@extends('adminlte::page')

@section('title', 'Notas de Credito')

@section('content_header')
    <h1>Notas de Credito</h1>
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
                                {{ __('Notas de credito') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('notasdecreditos.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Crear Nueva Nota de Credito') }}
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
                                        <th>No</th>
                                        
										<th>Ejercicio</th>
										<th>Institucion</th>
										<th>Beneficiario</th>
										<th>Banco</th>
										<th>Cuenta bancaria</th>
										<th>Fecha</th>
										<th>Referencia</th>
										<th>Descripcion</th>
										<th>Monto</th>
                                        <th>Usuario</th>

                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($notasdecreditos as $notasdecredito)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $notasdecredito->ejercicio->ejercicioejecucion }}</td>
											<td>{{ $notasdecredito->institucione->institucion }}</td>
											<td>{{ $notasdecredito->beneficiario->nombre }}</td>
											<td>{{ $notasdecredito->banco->denominacion }}</td>
											<td>{{ $notasdecredito->cuentasbancaria->cuenta }}</td>
											<td>{{ $notasdecredito->fecha }}</td>
											<td>{{ $notasdecredito->referencia }}</td>
											<td>{{ $notasdecredito->descripcion }}</td>
											<td>{{ number_format($notasdecredito->monto, 2 ,',','.') }}</td>

                                            <td>{{ $notasdecredito->usuario->name }}</td>
                                            <td>
                                                <form action="{{ route('notasdecreditos.destroy',$notasdecredito->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('notasdecreditos.show',$notasdecredito->id) }}"><i class="fa fa-fw fa-eye"></i> Mostrar</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('notasdecreditos.edit',$notasdecredito->id) }}"><i class="fa fa-fw fa-edit"></i> Editar</a>
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
                {!! $notasdecreditos->links() !!}
            </div>
        </div>
    </div>
    @stop

@section('css')

    <link rel="stylesheet" href="/css/admin_custom.css">
@stop
