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
                                <a href="{{ route('requidetclaspres.create') }}" class="btn btn-outline-dark btn-sm float-right"  data-placement="left">
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
                    <form method="GET">
<div class="input-group mb-3">
  <input type="text" name="search" class="form-control" placeholder="Buscar">
  <button class="btn btn-outline-primary" type="submit" id="button-addon2">Buscar</button>
</div>
</form>


                        <div class="table-responsive">
                                  <table class="table table-hover  small table-bordered table-striped">
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
                                                <form action="{{ route('requidetclaspres.destroy',$requidetclaspre->id) }}" method="POST" class="submit-prevent-form">
                                                    <a class="btn btn-sm btn-block btn btn-outline-dark btn-block" href="{{ route('requidetclaspres.show',$requidetclaspre->id) }}"><i class="fas fa-print"></i> Show</a>
                                                    <a class="btn btn-sm btn-block btn btn-outline-dark btn-block" href="{{ route('requidetclaspres.edit',$requidetclaspre->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-outline-danger btn-sm btn-block submit-prevent-button"><i class="fa fa-fw fa-trash"></i> Delete</button>
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
