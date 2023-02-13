@extends('layouts.app')

@section('template_title')
    Clase
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Clase') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('clases.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                <thead class="thead">
                                    <tr>
                                        <th class="text-center">Nro</th>
                                        
										<th class="text-center">Codigo clase</th>
										<th class="text-center">Nombre</th>
										<th class="text-center">Familia Id</th>

                                        <th class="text-center">Acción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($clases as $clase)
                                        <tr>
                                            <td class="text-center">{{ ++$i }}</td>
                                            
											<td class="text-center">{{ $clase->codigoclase }}</td>
											<td class="text-center">{{ $clase->nombre }}</td>
											<td class="text-center">{{ $clase->familia->nombre}}</td>
                                            
                                            <td class="text-center">
                                                <form action="{{ route('clases.destroy',$clase->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('clases.show',$clase->id) }}"><i class="fa fa-fw fa-eye"></i> Mostrar</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('clases.edit',$clase->id) }}"><i class="fa fa-fw fa-edit"></i> Editar</a>
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
                {!! $clases->links() !!}
            </div>
        </div>
    </div>
@endsection
