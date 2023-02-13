@extends('layouts.app')

@section('template_title')
    Detallescompromiso
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Detallescompromiso') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('detallescompromisos.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
										<th>Compromiso Id</th>
										<th>Unidadadministrativa Id</th>
										<th>Ejecucion Id</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($detallescompromisos as $detallescompromiso)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $detallescompromiso->montocompromiso }}</td>
											<td>{{ $detallescompromiso->compromiso_id }}</td>
											<td>{{ $detallescompromiso->unidadadministrativa_id }}</td>
											<td>{{ $detallescompromiso->ejecucion_id }}</td>

                                            <td>
                                                <form action="{{ route('detallescompromisos.destroy',$detallescompromiso->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('detallescompromisos.show',$detallescompromiso->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('detallescompromisos.edit',$detallescompromiso->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
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
                {!! $detallescompromisos->links() !!}
            </div>
        </div>
    </div>
@endsection
