@extends('adminlte::page')

@section('title', 'Tipos de Movimientos')

@section('content_header')
    <h1>Tipos de Movimientos</h1>
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
                                {{ __('Tipo de movimiento bancario') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('tipomovimientos.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Crear nuevo') }}
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

										<th>Descripcion</th>
										<th>Accion</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tipomovimientos as $tipomovimiento)
                                        <tr>
                                            <td>{{ ++$i }}</td>

											<td>{{ $tipomovimiento->descripcion }}</td>
											<td>{{ $tipomovimiento->accion }}</td>

                                            <td>
                                                <form action="{{ route('tipomovimientos.destroy',$tipomovimiento->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('tipomovimientos.show',$tipomovimiento->id) }}"><i class="fa fa-fw fa-eye"></i> Mostrar</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('tipomovimientos.edit',$tipomovimiento->id) }}"><i class="fa fa-fw fa-edit"></i>Editar</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> Borrar</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $tipomovimientos->links() !!}
            </div>
        </div>
    </div>

    @stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop