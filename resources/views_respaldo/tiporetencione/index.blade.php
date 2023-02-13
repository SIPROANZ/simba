@extends('adminlte::page')


@section('title', 'Tipo de Retenciones')

@section('content_header')
    <h1>Tipo de Retenciones</h1>
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
                                {{ __('Tipos de Retenciones') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('tiporetenciones.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Crear Nuevo Tipo') }}
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

										<th>Tipo</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tiporetenciones as $tiporetencione)
                                        <tr>
                                            <td>{{ ++$i }}</td>

											<td>{{ $tiporetencione->tipo }}</td>

                                            <td>
                                                <form action="{{ route('tiporetenciones.destroy',$tiporetencione->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('tiporetenciones.show',$tiporetencione->id) }}"><i class="fa fa-fw fa-eye"></i> Ver</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('tiporetenciones.edit',$tiporetencione->id) }}"><i class="fa fa-fw fa-edit"></i> Editar</a>
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
                {!! $tiporetenciones->links() !!}
            </div>
        </div>
    </div>
    @stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop