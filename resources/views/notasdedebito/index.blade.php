@extends('adminlte::page')

@section('title', 'Notas de Debito')

@section('content_header')
    <h1>Notas de Debito</h1>
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
                                {{ __('Notas de debito') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('notasdedebitos.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Crear Nota de Debito') }}
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
                                    @foreach ($notasdedebitos as $notasdedebito)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $notasdedebito->ejercicio->ejercicioejecucion }}</td>
											<td>{{ $notasdedebito->institucione->institucion }}</td>
											<td>{{ $notasdedebito->beneficiario->nombre }}</td>
											<td>{{ $notasdedebito->banco->denominacion }}</td>
											<td>{{ $notasdedebito->cuentasbancaria->cuenta }}</td>
											<td>{{ $notasdedebito->fecha }}</td>
											<td>{{ $notasdedebito->referencia }}</td>
											<td>{{ $notasdedebito->descripcion }}</td>
											<td>{{ number_format($notasdedebito->monto,2,',','.') }}</td>
                                            <td>{{ $notasdedebito->usuario->name }}</td>

                                            <td>
                                                <form action="{{ route('notasdedebitos.destroy',$notasdedebito->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('notasdedebitos.show',$notasdedebito->id) }}"><i class="fa fa-fw fa-eye"></i> Mostrar</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('notasdedebitos.edit',$notasdedebito->id) }}"><i class="fa fa-fw fa-edit"></i> Editar</a>
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
                {!! $notasdedebitos->links() !!}
            </div>
        </div>
    </div>
    @stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop
