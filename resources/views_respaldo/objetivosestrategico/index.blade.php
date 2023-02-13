@extends('layouts.app')

@section('template_title')
    Objetivosestrategico
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Objetivos Estrategicos') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('objetivosestrategicos.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Crear Nuevo Objetivo Estrategico') }}
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
                                        
										<th>Numeracion</th>
										<th>Objetivo Estrategico</th>
										<th>Objetivo Nacional</th>

                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($objetivosestrategicos as $objetivosestrategico)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $objetivosestrategico->objetivoestrategico }}</td>
											<td>{{ $objetivosestrategico->objetivo }}</td>
											<td>{{ $objetivosestrategico->objetivonacionale->objetivo }}</td>

                                            <td>
                                                <form action="{{ route('objetivosestrategicos.destroy',$objetivosestrategico->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('objetivosestrategicos.show',$objetivosestrategico->id) }}"><i class="fa fa-fw fa-eye"></i> Ver</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('objetivosestrategicos.edit',$objetivosestrategico->id) }}"><i class="fa fa-fw fa-edit"></i> Editar</a>
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
                {!! $objetivosestrategicos->links() !!}
            </div>
        </div>
    </div>
@endsection
