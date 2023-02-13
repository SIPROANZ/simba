@extends('layouts.app')

@section('template_title')
    Detalleretencione
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Detalleretencione') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('detalleretenciones.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                        
										<th>Retencion Id</th>
										<th>Ordenpago Id</th>
										<th>Montoneto</th>
										<th>Montoiva</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($detalleretenciones as $detalleretencione)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $detalleretencione->retencion_id }}</td>
											<td>{{ $detalleretencione->ordenpago_id }}</td>
											<td>{{ $detalleretencione->montoneto }}</td>
											<td>{{ $detalleretencione->montoIVA }}</td>

                                            <td>
                                                <form action="{{ route('detalleretenciones.destroy',$detalleretencione->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('detalleretenciones.show',$detalleretencione->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('detalleretenciones.edit',$detalleretencione->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
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
                {!! $detalleretenciones->links() !!}
            </div>
        </div>
    </div>
@endsection
