@extends('layouts.app')

@section('template_title')
    Detallesayuda
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Detallesayuda') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('detallesayudas.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Create New') }}
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
                                        
										<th>Montocompromiso</th>
										<th>Ayuda Id</th>
										<th>Unidadadministrativa Id</th>
										<th>Ejecucion Id</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($detallesayudas as $detallesayuda)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $detallesayuda->montocompromiso }}</td>
											<td>{{ $detallesayuda->ayuda_id }}</td>
											<td>{{ $detallesayuda->unidadadministrativa_id }}</td>
											<td>{{ $detallesayuda->ejecucion_id }}</td>

                                            <td>
                                                <form action="{{ route('detallesayudas.destroy',$detallesayuda->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('detallesayudas.show',$detallesayuda->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('detallesayudas.edit',$detallesayuda->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $detallesayudas->links() !!}
            </div>
        </div>
    </div>
@endsection
