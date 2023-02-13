@extends('layouts.app')

@section('template_title')
    Ejercicio
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Ejercicio') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('ejercicios.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                        
										<th class="text-center">Nombre Ejercicio</th>
										<th class="text-center">Ejercicio Origen</th>
										<th class="text-center">Ejercicio Ejecución</th>
										<th class="text-center">Status</th>
										<th class="text-center">Observación</th>

                                        <th class="text-center" >Acción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($ejercicios as $ejercicio)
                                        <tr>
                                            <td class="text-center">{{ ++$i }}</td>
                                            
											<td class="text-center">{{ $ejercicio->nombreejercicio }}</td>
											<td class="text-center">{{ $ejercicio->ejercicioorigen }}</td>
											<td class="text-center">{{ $ejercicio->ejercicioejecucion }}</td>
											<td class="text-center">{{ $ejercicio->estatus }}</td>
											<td class="text-center">{{ $ejercicio->observacion }}</td>

                                            <td class="text-center">
                                                <form action="{{ route('ejercicios.destroy',$ejercicio->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('ejercicios.show',$ejercicio->id) }}"><i class="fa fa-fw fa-eye"></i> Mostrar</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('ejercicios.edit',$ejercicio->id) }}"><i class="fa fa-fw fa-edit"></i> Editar</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i>Eliminar</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $ejercicios->links() !!}
            </div>
        </div>
    </div>
@endsection
