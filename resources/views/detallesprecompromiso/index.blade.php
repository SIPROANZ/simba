@extends('adminlte::page')

@section('title', 'Precompromiso')

@section('content_header')
    <h1>Agregar Detalles Precompromiso</h1>
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
                                {{ __('Detalles precompromisos') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('detallesprecompromisos.create') }}" class="btn btn-outline-dark btn-sm float-right"  data-placement="left">
                                  {{ __('Crear Nuevo detalle') }}
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
                                        
										<th>Monto compromiso</th>
										<th>Precompromiso</th>
										<th>Unidad administrativa</th>
										<th>Ejecucion</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($detallesprecompromisos as $detallesprecompromiso)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $detallesprecompromiso->montocompromiso }}</td>
											<td>{{ $detallesprecompromiso->precompromiso_id }}</td>
											<td>{{ $detallesprecompromiso->unidadadministrativa_id }}</td>
											<td>{{ $detallesprecompromiso->ejecucion_id }}</td>

                                            <td>
                                                <form action="{{ route('detallesprecompromisos.destroy',$detallesprecompromiso->id) }}" method="POST" class="submit-prevent-form">
                                                    <a class="btn btn-sm btn-block btn btn-outline-dark btn-block" href="{{ route('detallesprecompromisos.show',$detallesprecompromiso->id) }}"><i class="fas fa-print"></i> Show</a>
                                                    <a class="btn btn-sm btn-block btn btn-outline-dark btn-block" href="{{ route('detallesprecompromisos.edit',$detallesprecompromiso->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
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
                {!! $detallesprecompromisos->links() !!}
            </div>
        </div>
    </div>
    @stop
    
    @section('css')
    
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop
