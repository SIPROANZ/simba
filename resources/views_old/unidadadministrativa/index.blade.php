@extends('adminlte::page')


@section('title', 'Unidad Administrativa')

@section('content_header')
    <h1>Unidad Administrativa</h1>
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
                                {{ __('Unidad Administrativa') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('unidadadministrativas.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered table-striped">
                                <thead>
                                    <tr>
                                    <th>No</th>
                                        <th  class="text-center">Ejercicio</th>
										<th  class="text-center">Sector</th>
										<th  class="text-center">Programa</th>
										<th  class="text-center">Subprograma</th>
										<th  class="text-center">Proyecto</th>
										<th  class="text-center">Actividad</th>
										<th  class="text-center">Denominación</th>
										<th  class="text-center">Unidad ejecutora</th>
										<th  class="text-center">Institucion Id</th>
										<th  class="text-center">Nivel</th>
										<th  class="text-center">Email</th>
										<th  class="text-center">Teléfono</th>
										<th  class="text-center">Descripción</th>
										<th  class="text-center">Inversión</th>
										<th  class="text-center">Nivel ejecutor</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($unidadadministrativas as $unidadadministrativa)
                                        <tr>
                                        <td  class="text-center">{{ ++$i }}</td>
                                            
											<td  class="text-center">{{ $unidadadministrativa->ejercicio_id }}</td>
											<td  class="text-center">{{ $unidadadministrativa->sector }}</td>
											<td  class="text-center">{{ $unidadadministrativa->programa }}</td>
											<td  class="text-center">{{ $unidadadministrativa->subprograma }}</td>
											<td  class="text-center">{{ $unidadadministrativa->proyecto }}</td>
											<td  class="text-center">{{ $unidadadministrativa->actividad }}</td>
											<td  class="text-center">{{ $unidadadministrativa->denominacion }}</td>
											<td  class="text-center">{{ $unidadadministrativa->unidadejecutora }}</td>
											<td  class="text-center">{{ $unidadadministrativa->institucion_id }}</td>
											<td  class="text-center">{{ $unidadadministrativa->nivel }}</td>
											<td  class="text-center">{{ $unidadadministrativa->email }}</td>
											<td  class="text-center">{{ $unidadadministrativa->telefono }}</td>
											<td  class="text-center">{{ $unidadadministrativa->descripcion }}</td>
											<td  class="text-center">{{ $unidadadministrativa->inversion }}</td>
											<td  class="text-center">{{ $unidadadministrativa->nivelejecutor }}</td>

                                            <td  class="text-center">
                                                <form action="{{ route('unidadadministrativas.destroy',$unidadadministrativa->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('unidadadministrativas.show',$unidadadministrativa->id) }}"><i class="fa fa-fw fa-eye"></i> Mostrar</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('unidadadministrativas.edit',$unidadadministrativa->id) }}"><i class="fa fa-fw fa-edit"></i> Editar</a>
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
                {!! $unidadadministrativas->links() !!}
            </div>
        </div>
    </div>
    @stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop
