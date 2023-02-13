@extends('layouts.app')

@section('template_title')
    Objetivonacionale
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Objetivos Nacionales') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('objetivonacionales.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Crear Nuevo Objetivo Nacional') }}
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
                                        
										<th>Numeral</th>
										<th>Objetivo Nacional</th>
										<th>Objetivo Historico</th>

                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($objetivonacionales as $objetivonacionale)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $objetivonacionale->objetivonacional }}</td>
											<td>{{ $objetivonacionale->objetivo }}</td>
											<td>{{ $objetivonacionale->objetivoshistorico->objetivo }}</td>

                                            <td>
                                                <form action="{{ route('objetivonacionales.destroy',$objetivonacionale->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('objetivonacionales.show',$objetivonacionale->id) }}"><i class="fa fa-fw fa-eye"></i> Ver</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('objetivonacionales.edit',$objetivonacionale->id) }}"><i class="fa fa-fw fa-edit"></i> Editar</a>
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
                {!! $objetivonacionales->links() !!}
            </div>
        </div>
    </div>
@endsection
