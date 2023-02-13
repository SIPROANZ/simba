@extends('layouts.app')

@section('template_title')
    Objetivogenerale
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Objetivo Generales') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('objetivogenerales.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                        
										<th class="text-center">Objetivo General</th>
										<th class="text-center">Objetivo</th>
										<th class="text-center">Objetivo Estrategico</th>

                                        <th class="text-center">Acción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($objetivogenerales as $objetivogenerale)
                                        <tr>
                                            <td class="text-center">{{ ++$i }}</td>
                                            
											<td class="text-center">{{ $objetivogenerale->objetivogeneral }}</td>
											<td class="text-center">{{ $objetivogenerale->objetivo }}</td>
											<td class="text-center">{{ $objetivogenerale->objetivosestrategico->objetivo }}</td>

                        
                                            <td class="text-center">
                                                <form action="{{ route('objetivogenerales.destroy',$objetivogenerale->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('objetivogenerales.show',$objetivogenerale->id) }}"><i class="fa fa-fw fa-eye"></i> Mostrar</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('objetivogenerales.edit',$objetivogenerale->id) }}"><i class="fa fa-fw fa-edit"></i> Editar</a>
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
                {!! $objetivogenerales->links() !!}
            </div>
        </div>
    </div>
@endsection
