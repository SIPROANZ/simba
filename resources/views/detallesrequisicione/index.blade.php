@extends('adminlte::page')

@section('title', 'Requisiciones')

@section('content_header')
    <h1>Detalles Requisiciones</h1>
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
                                {{ __('Detalles requisiciones') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('detallesrequisiciones.create') }}" class="btn btn-outline-dark btn-sm float-right"  data-placement="left">
                                  {{ __('Crear Nuevo Detalles Requisiciones') }}
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
                                        
										<th>Requisicion</th>
										<th>Bos</th>
										<th>Cantidad</th>

                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($detallesrequisiciones as $detallesrequisicione)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $detallesrequisicione->requisicione->concepto }}</td>
											<td>{{ $detallesrequisicione->bo->descripcion }}</td>
											<td>{{ $detallesrequisicione->cantidad }}</td>

                                            <td>
                                                <form action="{{ route('detallesrequisiciones.destroy',$detallesrequisicione->id) }}" method="POST" class="submit-prevent-form">
                                                    <a class="btn btn-sm btn-block btn btn-outline-dark btn-block" href="{{ route('detallesrequisiciones.show',$detallesrequisicione->id) }}"><i class="fas fa-print"></i> Mostrar</a>
                                                    <a class="btn btn-sm btn-block btn btn-outline-dark btn-block" href="{{ route('detallesrequisiciones.edit',$detallesrequisicione->id) }}"><i class="fa fa-fw fa-edit"></i> Editar</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-outline-danger btn-sm btn-block submit-prevent-button"><i class="fa fa-fw fa-trash"></i> Eliminar</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $detallesrequisiciones->links() !!}
            </div>
        </div>
    </div>
    @stop
    
    @section('css')
    
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop
