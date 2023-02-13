@extends('layouts.app')

@section('template_title')
    Instituciones
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Instituciones') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('instituciones.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        <th>Logo</th>
										<th>Rif</th>
										<th>Institución</th>
                                        <th>Razon Social</th>
										<th>Municipio</th>
										<th>Dirección</th>
										<th>Teléfono</th>
										<th>Email</th>
										<th>Pagina Web</th>
										<th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($instituciones as $institucione)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $institucione->logoinstitucion }}</td>
											<td>{{ $institucione->rif }}</td>

											<td>{{ $institucione->institucion }}</td>
                                            <td>{{ $institucione->razonsocial }}</td>
											<td>{{ $institucione->municipio->nombre }}</td>
											<td>{{ $institucione->direccion }}</td>
											<td>{{ $institucione->telefono }}</td>
											<td>{{ $institucione->email }}</td>
											<td>{{ $institucione->web }}</td>
                                            <td>
                                                <form action="{{ route('instituciones.destroy',$institucione->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('instituciones.show',$institucione->id) }}"><i class="fa fa-fw fa-eye"></i> Ver</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('instituciones.edit',$institucione->id) }}"><i class="fa fa-fw fa-edit"></i> Editar</a>
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
                {!! $instituciones->links() !!}
            </div>
        </div>
    </div>
@endsection
