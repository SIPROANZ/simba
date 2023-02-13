@extends('layouts.app')

@section('template_title')
    Segmento
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Segmento') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('segmentos.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                        
										<th class="text-center">Código</th>
										<th class="text-center">Nombre</th>

                                        <th class="text-center">Acción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($segmentos as $segmento)
                                        <tr>
                                            <td class="text-center">{{ ++$i }}</td>
                                            
											<td class="text-center">{{ $segmento->codigo }}</td>
											<td class="text-center">{{ $segmento->nombre }}</td>

                                            <td class="text-center">
                                                <form action="{{ route('segmentos.destroy',$segmento->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('segmentos.show',$segmento->id) }}"><i class="fa fa-fw fa-eye"></i> Mostrar</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('segmentos.edit',$segmento->id) }}"><i class="fa fa-fw fa-edit"></i> Editar</a>
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
                {!! $segmentos->links() !!}
            </div>
        </div>
    </div>
@endsection
