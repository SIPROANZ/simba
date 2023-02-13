@extends('adminlte::page')

@section('title', 'Comprobantes de Retenciones')

@section('content_header')
    <h1>Comprobantes de Retenciones</h1>
@stop

@section('content')
<br>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Comprobantes de retenciones') }}
                            </span>

                             <div class="float-right">
                                {{--<a href="{{ route('comprobantesretenciones.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Create New') }}
                                </a> --}}
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
                                        
										<th>Tipo retencion</th>
										<th>Orden pago</th>
										<th>Monto retencion</th>
										<th>Status</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($comprobantesretenciones as $comprobantesretencione)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $comprobantesretencione->tiporetencione->tipo }}</td>
											<td>{{ $comprobantesretencione->ordenpago->nordenpago }}</td>
											<td>{{ number_format($comprobantesretencione->montoretencion,2,',','.')}}</td>
											<td>{{ $comprobantesretencione->status }}</td>

                                            <td>
                                            <a class="btn btn-sm btn-primary " href="{{ route('comprobantesretenciones.show',$comprobantesretencione->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                    {{--
                                                <form action="{{ route('comprobantesretenciones.destroy',$comprobantesretencione->id) }}" method="POST">
                                                   <a class="btn btn-sm btn-success" href="{{ route('comprobantesretenciones.edit',$comprobantesretencione->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> Delete</button>
                                                </form> --}}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $comprobantesretenciones->links() !!}
            </div>
        </div>
    </div>
    @stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop
