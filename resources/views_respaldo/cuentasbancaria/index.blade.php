@extends('layouts.app')

@section('template_title')
    Cuentasbancaria
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Cuentas bancarias') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('cuentasbancarias.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Crear nuevo cuenta') }}
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
                                        <th style="text-align: left">No</th>
                                        
										<th style="text-align: left">Banco</th>
										<th style="text-align: left">Institucion</th>
										<th style="text-align: left">Fecha apertura</th>
										<th style="text-align: left">Monto apertura</th>
										<th style="text-align: left">Monto saldo</th>
										<th style="text-align: left">Cuenta</th>
										<th style="text-align: left">Descripcion</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cuentasbancarias as $cuentasbancaria)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td style="text-align: left">{{ $cuentasbancaria->banco->denominacion }}</td>
											<td style="text-align: left">{{ $cuentasbancaria->institucione->institucion}}</td>
											<td style="text-align: left">{{ $cuentasbancaria->fechaapertura }}</td>
											<td style="text-align: left">{{ $cuentasbancaria->montoapertura }}</td>
											<td style="text-align: left">{{ $cuentasbancaria->montosaldo }}</td>
											<td style="text-align: left">{{ $cuentasbancaria->cuenta }}</td>
											<td style="text-align: left">{{ $cuentasbancaria->descripcion }}</td>

                                            <td>
                                                <form action="{{ route('cuentasbancarias.destroy',$cuentasbancaria->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('cuentasbancarias.show',$cuentasbancaria->id) }}"><i class="fa fa-fw fa-eye"></i> Mostrar</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('cuentasbancarias.edit',$cuentasbancaria->id) }}"><i class="fa fa-fw fa-edit"></i> Editar</a>
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
                {!! $cuentasbancarias->links() !!}
            </div>
        </div>
    </div>
@endsection
