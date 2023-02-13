@extends('layouts.app')

@section('template_title')
    Detalleordenpago
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Detalleordenpago') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('detalleordenpagos.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                        
										<th>Ordenpago Id</th>
										<th>Unidadadministrativa Id</th>
										<th>Ejecucion Id</th>
										<th>Monto</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($detalleordenpagos as $detalleordenpago)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $detalleordenpago->ordenpago_id }}</td>
											<td>{{ $detalleordenpago->unidadadministrativa_id }}</td>
											<td>{{ $detalleordenpago->ejecucion_id }}</td>
											<td>{{ $detalleordenpago->monto }}</td>

                                            <td>
                                                <form action="{{ route('detalleordenpagos.destroy',$detalleordenpago->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('detalleordenpagos.show',$detalleordenpago->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('detalleordenpagos.edit',$detalleordenpago->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
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
                {!! $detalleordenpagos->links() !!}
            </div>
        </div>
    </div>
@endsection
