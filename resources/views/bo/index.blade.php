@extends('adminlte::page')

@section('title', '  BOS (Bienes/Obras/Servicios)')

@section('content_header')
    <h1>  BOS (Bienes/ Obras / Servicios)</h1>
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
                                {{ __('BOS (Bienes/Obras/Servicios)') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('bos.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Crear Nuevo') }}
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
										<th>Producto</th>
										<th>Unidad de Medida</th>
										<th>Tipo de BOS</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($bos as $bo)
                                        <tr>
                                            <td>{{ ++$i }}</td>
											<td>{{ $bo->descripcion }}</td>
											<td>{{ $bo->productos->codigoproducto .' - '  . $bo->productos->nombre }}</td>
											<td>{{ $bo->unidadmedida->nombre }}</td>
											<td>{{ $bo->tipobo->nombre }}</td>

                                            <td>
                                                <form action="{{ route('bos.destroy',$bo->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('bos.show',$bo->id) }}"><i class="fa fa-fw fa-eye"></i> Ver</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('bos.edit',$bo->id) }}"><i class="fa fa-fw fa-edit"></i> Editar</a>
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
                {!! $bos->links() !!}
            </div>
        </div>
    </div>

    @stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop
