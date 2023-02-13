@extends('adminlte::page')


@section('title', 'Agregar')

@section('content_header')
    <h1>Agregar una nueva requisicion</h1>
@stop

@section('content')
<br>
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">REQUISICION</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('requisiciones.index') }}"> Regresar</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        
                        <div class="form-group">
                            <strong>Unidad administrativa:</strong>
                            {{ $requisicione->unidadadministrativa->denominacion }}
                        </div>
                        <div class="form-group">
                            <strong>Correlativo:</strong>
                            {{ $requisicione->correlativo }}
                        </div>
                        <div class="form-group">
                            <strong>Concepto:</strong>
                            {{ $requisicione->concepto }}
                        </div>
                        <div class="form-group">
                            <strong>Uso:</strong>
                            {{ $requisicione->uso }}
                        </div>
                      

                    </div>
                </div>
            </div>
        </div>
    </section>

<!-- Agregamos la tabla detalles de la requisicion es decir las compras -->
<div class="container-fluid">
    <br>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Detalles de la requisiciones') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('detallesrequisiciones.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Agregar Nuevo Detalle') }}
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
                                        
										<th>Bos</th>
										<th>Cantidad</th>

                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($detallesrequisiciones as $detallesrequisicione)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $detallesrequisicione->bo->descripcion }}</td>
											<td>{{ $detallesrequisicione->cantidad }}</td>

                                            <td>
                                                <form action="{{ route('detallesrequisiciones.destroy',$detallesrequisicione->id) }}" method="POST">
                                                    
                                                    <a class="btn btn-sm btn-success" href="{{ route('detallesrequisiciones.edit',$detallesrequisicione->id) }}"><i class="fa fa-fw fa-edit"></i> Editar</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> Eliminar</button>
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
