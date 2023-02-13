@extends('layouts.app')

@section('template_title')
    Poa
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Plan operativo anual') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('poas.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Crear Nueva Plan operativo anual') }}
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
                                        
										< 
										<th style="text-align: left">Ejercicio</th>
										<th style="text-align: left">Institucion</th>										 
										<th style="text-align: left">Historico</th>										 
										<th style="text-align: left">Nacional</th>										 
										<th style="text-align: left">Estrategico</th>										 
										<th style="text-align: left">General</th>										 
										<th style="text-align: left">Municipal</th>										 
										<th style="text-align: left">Pei</th>										 
										<th style="text-align: left">Unidad administrativa</th>										 
										<th style="text-align: left">Proyecto</th>										 
										<th style="text-align: left">Objetivo proyecto</th>										 
										<th style="text-align: left">Monto proyecto</th>									 
										<th style="text-align: left">Responsable</th>										 
										<th style="text-align: left">Tipo</th>										 
										<th style="text-align: left">SNCF estrategico</th>										 
										<th style="text-align: left">SNCF especifico</th>										 
										<th style="text-align: left">P. social</th>									 
										<th style="text-align: left">Codigo</th>										 
										<th style="text-align: left">Tipo proyecto</th>										 
										<th style="text-align: left">Central</th>										 
										<th style="text-align: left">Descripcion</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($poas as $poa)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td style="text-align: left">{{ $poa->ejercicio->nombreejercicio }}</td>
                                            <td style="text-align: left">{{ $poa->institucione->institucion }}</td>
                                            <td style="text-align: left">{{ $poa->objetivoshistorico->objetivo }}</td>
                                            <td style="text-align: left">{{ $poa->objetivonacionale->objetivo}}</td>
                                            <td style="text-align: left">{{ $poa->objetivosestrategico->objetivo }}</td>
                                            <td style="text-align: left">{{ $poa->nacional_id }}</td>
                                            <td style="text-align: left">{{ $poa->objetivomunicipale->objetivo}}</td>
                                            <td style="text-align: left">{{ $poa->objetivopei->objetivo }}</td>
											<td style="text-align: left">{{ $poa->unidadadministrativa->sector }}</td>
                                            <td style="text-align: left">{{ $poa->proyecto }}</td>
                                            <td style="text-align: left">{{ $poa->objetivoproyecto }}</td>
                                            <td style="text-align: left">{{ $poa->montoproyecto }}</td>
											<td style="text-align: left">{{ $poa->responsable }}</td>
                                            <td style="text-align: left">{{ $poa->tipo }}</td>
                                            <td style="text-align: left">{{ $poa->sncfestrategico }}</td>
                                            <td style="text-align: left">{{ $poa->sncfespecifico }}</td>
                                            <td style="text-align: left">{{ $poa->psocial }}</td>
                                            <td style="text-align: left">{{ $poa->codigo }}</td>
                                            <td style="text-align: left">{{ $poa->tipoproyecto }}</td>
                                            <td style="text-align: left">{{ $poa->central }}</td>
                                            <td style="text-align: left">{{ $poa->descripcion }}</td>

                                            <td style="text-align: left">
                                                <form action="{{ route('poas.destroy',$poa->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('poas.show',$poa->id) }}"><i class="fa fa-fw fa-eye"></i> Ver</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('poas.edit',$poa->id) }}"><i class="fa fa-fw fa-edit"></i> Editar</a>
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
                {!! $poas->links() !!}
            </div>
        </div>
    </div>
@endsection
