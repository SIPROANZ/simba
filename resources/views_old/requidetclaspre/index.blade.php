@extends('layouts.app')

@section('template_title')
    Requidetclaspre
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Requidetclaspre') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('requidetclaspres.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                        
										<th>Requisicion Id</th>
										<th>Poa Id</th>
										<th>Meta Id</th>
										<th>Financiamiento Id</th>
										<th>Disponible</th>
										<th>Claspres</th>
										<th>Ejecucion Id</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($requidetclaspres as $requidetclaspre)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $requidetclaspre->requisicion_id }}</td>
											<td>{{ $requidetclaspre->poa_id }}</td>
											<td>{{ $requidetclaspre->meta_id }}</td>
											<td>{{ $requidetclaspre->financiamiento_id }}</td>
											<td>{{ $requidetclaspre->disponible }}</td>
											<td>{{ $requidetclaspre->claspres }}</td>
											<td>{{ $requidetclaspre->ejecucion_id }}</td>

                                            <td>
                                                <form action="{{ route('requidetclaspres.destroy',$requidetclaspre->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('requidetclaspres.show',$requidetclaspre->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('requidetclaspres.edit',$requidetclaspre->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
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
                {!! $requidetclaspres->links() !!}
            </div>
        </div>
    </div>
@endsection
