@extends('layouts.app')

@section('template_title')
    Modificacione
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Modificaciones Presupuestarias Anuladas') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('modificaciones.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Crear Modificacion') }}
                                </a>
                                <a href="{{ route('modificaciones.index') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('En Proceso') }}
                                </a>
                                <a href="{{ route('modificaciones.procesadas') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Procesadas') }}
                                </a>
                                <a href="{{ route('modificaciones.anuladas') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Anuladas') }}
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
                                        
										<th>Numero</th>
										<th>Tipomodificacion Id</th>
										<th>Descripcion</th>
										<th>Status</th>
										<th>Fechaanulacion</th>
										<th>Montocredita</th>
										<th>Montodebita</th>
										<th>Ncredito</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($modificaciones as $modificacione)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $modificacione->numero }}</td>
											<td>{{ $modificacione->tipomodificacione->nombre }}</td>
											<td>{{ $modificacione->descripcion }}</td>
											<td>@if ($modificacione->status == 'EP')
                                                    EN PROCESO
                                                @elseif ($modificacione->status == 'PR')
                                                    PROCESADA
                                                @elseif ($modificacione->status == 'AP')
                                                    APROBADA
                                                @elseif ($modificacione->status == 'AN')
                                                    ANULADA
                                                @endif</td>
											<td>{{ $modificacione->fechaanulacion }}</td>
											<td>{{ $modificacione->montocredita }}</td>
											<td>{{ $modificacione->montodebita }}</td>
											<td>{{ $modificacione->ncredito }}</td>

                                            <td>
                        
                                            <a class="btn btn-sm btn-primary " href="{{ route('modificaciones.pdf',$modificacione->id) }}" data-toggle="tooltip" data-placement="top" title="Imprimir Modificacion"><i class="fa fa-fw fa-print"></i></a>
                         
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $modificaciones->links() !!}
            </div>
        </div>
    </div>
    @stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop
