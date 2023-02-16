@extends('adminlte::page')


@section('title', 'Beneficiarios')

@section('content_header')
    <h1>Beneficiarios</h1>
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
                                {{ __('Beneficiarios') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('beneficiarios.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Crear nuevo Beneficiario') }}
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
                                        
										<th>Persona</th>
										<th>Documento</th>
										<th>Rif</th>
										<th>Nombre Beneficiario</th>
										<th>Direccion</th>
										
                                        <th>Usuario</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($beneficiarios as $beneficiario)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $beneficiario->caracterbeneficiario }}</td>
											<td>{{ $beneficiario->documento }}</td>
											<td>{{ $beneficiario->rif }}</td>
											<td>{{ $beneficiario->nombre }}</td>
											<td>{{ $beneficiario->direccion }}</td>
											
											<td>{{ $beneficiario->usuario->name }}</td>

                                            <td>
                                                <form action="{{ route('beneficiarios.destroy',$beneficiario->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('beneficiarios.show',$beneficiario->id) }}"><i class="fa fa-fw fa-eye"></i> Mostrar</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('beneficiarios.edit',$beneficiario->id) }}"><i class="fa fa-fw fa-edit"></i> Editar</a>
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
                {!! $beneficiarios->links() !!}
            </div>
        </div>
    </div>
    @stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop
