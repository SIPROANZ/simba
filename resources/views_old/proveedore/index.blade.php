@extends('layouts.app')

@section('template_title')
    Proveedore
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Proveedores') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('proveedores.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Crear Nuevo Proveedor') }}
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
                                        
										<th>Caracter</th>
										<th>Documento</th>
										<th>Rif</th>
										<th>Tipo Residencia</th>
										<th>Tipo Proveedor</th>
										<th>Tipo Contribuyente</th>
										<th>Denominacion</th>
										<th>Direccion</th>
										<th>Telefono</th>
										<th>Correo</th>
										<th>Banco</th>
										<th>Numero de cuenta</th>
										<th>Documento del representante</th>
										<th>Nombre del representante</th>
										<th>Telefono del representante</th>
										<th>Correo del representante</th>
										<th>Banco del representante</th>
										<th>Numero de cuenta del representante</th>

                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($proveedores as $proveedore)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $proveedore->caracterbeneficiario }}</td>
											<td>{{ $proveedore->documento }}</td>
											<td>{{ $proveedore->rif }}</td>
											<td>{{ $proveedore->tiporesidencia }}</td>
											<td>{{ $proveedore->tipobeneficiario }}</td>
											<td>{{ $proveedore->tipocontribuyente }}</td>
											<td>{{ $proveedore->nombre }}</td>
											<td>{{ $proveedore->direccion }}</td>
											<td>{{ $proveedore->telefono }}</td>
											<td>{{ $proveedore->correo }}</td>
											<td>{{ $proveedore->banco }}</td>
											<td>{{ $proveedore->numerocuenta }}</td>
											<td>{{ $proveedore->documentorepresentante }}</td>
											<td>{{ $proveedore->nombrerepresentante }}</td>
											<td>{{ $proveedore->telefonorepresentante }}</td>
											<td>{{ $proveedore->correorepresentante }}</td>
											<td>{{ $proveedore->bancorepresentante }}</td>
											<td>{{ $proveedore->numerocuentarepresentante }}</td>

                                            <td>
                                                <form action="{{ route('proveedores.destroy',$proveedore->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('proveedores.show',$proveedore->id) }}"><i class="fa fa-fw fa-eye"></i> Mostrar</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('proveedores.edit',$proveedore->id) }}"><i class="fa fa-fw fa-edit"></i> Editar</a>
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
                {!! $proveedores->links() !!}
            </div>
        </div>
    </div>
@endsection
