@extends('adminlte::page')


@section('title', 'Retenciones')

@section('content_header')
    <h1>Retenciones</h1>
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
                                {{ __('Retenciones') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('retenciones.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Crear Nueva') }}
                                </a>
                              </div>
                        </div>
                    </div>
                    @if ($message = Session::get('Exitoso'))
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

										<th>Descripcion</th>
										<th>Porcentaje</th>
										<th>Tipo</th>
										<th>Tipo de Retención</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($retenciones as $retencione)
                                        <tr>
                                            <td>{{ ++$i }}</td>

											<td>{{ $retencione->descripcion }}</td>
											<td>{{ $retencione->porcentaje }}</td>
                                            <td>
                                                @if ($retencione->tipo == 'I')
                                                    Impuesto
                                                @else
                                                    Retencion
                                                @endif
                                            </td>
											{{-- <td>{{ $retencione->tipo }}</td> --}}
											<td>{{ $retencione->tiporetencione->tipo}}</td>

                                            <td>
                                                <form action="{{ route('retenciones.destroy',$retencione->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('retenciones.show',$retencione->id) }}"><i class="fa fa-fw fa-eye"></i> Ver</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('retenciones.edit',$retencione->id) }}"><i class="fa fa-fw fa-edit"></i> Editar</a>
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
                {!! $retenciones->links() !!}
            </div>
        </div>
    </div>
    @stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop
