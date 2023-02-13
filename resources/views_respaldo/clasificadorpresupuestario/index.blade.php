@extends('layouts.app')

@section('template_title')
    Clasificadorpresupuestario
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Clasificador presupuestario') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('clasificadorpresupuestarios.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Crear Nuevo Clasificador Presupuestario') }}
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
                                        
										<th>Cuenta</th>
										<th>Denominacion</th>

                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($clasificadorpresupuestarios as $clasificadorpresupuestario)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $clasificadorpresupuestario->cuenta }}</td>
											<td>{{ $clasificadorpresupuestario->denominacion }}</td>

                                            <td>
                                                <form action="{{ route('clasificadorpresupuestarios.destroy',$clasificadorpresupuestario->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('clasificadorpresupuestarios.show',$clasificadorpresupuestario->id) }}"><i class="fa fa-fw fa-eye"></i> Ver</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('clasificadorpresupuestarios.edit',$clasificadorpresupuestario->id) }}"><i class="fa fa-fw fa-edit"></i> Editar</a>
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
                {!! $clasificadorpresupuestarios->links() !!}
            </div>
        </div>
    </div>
@endsection
