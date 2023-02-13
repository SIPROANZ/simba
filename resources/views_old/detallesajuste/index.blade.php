@extends('layouts.app')

@section('template_title')
    Detallesajuste
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Detallesajuste') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('detallesajustes.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                        
										<th>Montoajuste</th>
										<th>Ajustes Id</th>
										<th>Unidadadministrativa Id</th>
										<th>Ejecucion Id</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($detallesajustes as $detallesajuste)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $detallesajuste->montoajuste }}</td>
											<td>{{ $detallesajuste->ajustes_id }}</td>
											<td>{{ $detallesajuste->unidadadministrativa_id }}</td>
											<td>{{ $detallesajuste->ejecucion_id }}</td>

                                            <td>
                                                <form action="{{ route('detallesajustes.destroy',$detallesajuste->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('detallesajustes.show',$detallesajuste->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('detallesajustes.edit',$detallesajuste->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
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
                {!! $detallesajustes->links() !!}
            </div>
        </div>
    </div>
@endsection
